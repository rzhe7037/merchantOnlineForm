<?php

class Pagination{
    public $paginationcode;
    public $page;
    public $limit= 100000;
    private $conn;
    public function __construct($conn){
        $this->conn = $conn;
    }
    public function queryWithPagination($query,$table){
        // Find out how many items are in the table

        $countquery = str_replace("*","COUNT(*)",$query);
        $total = $this->conn->query($countquery)->fetchColumn();
    
        // How many items to list per page
        $limit = $this->limit;
    
        // How many pages will there be
        $pages = ceil($total / $limit);
        
        // What page are we currently on?
        $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
            'options' => array(
                'default'   => 1,
                'min_range' => 1,
            ),
        )));
        $this->page = $page;
    
        // Calculate the offset for the query
        $offset = ($page - 1)  * $limit;
        $offset = ($offset<0)?0:$offset;
        // Some information to display to the user
        $start = $offset + 1;
        $end = min(($offset + $limit), $total);
    
        // The "back" link
        $prevlink = ($page > 1) ? '<li class="page-item"><a class="page-link" href="?page=1" title="First page">&laquo;</a> </li>  <li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '" title="Previous page">Previous</a></li>' : '<li class="page-item disabled"><a class="page-link" href="?page=1" title="First page">&laquo;</a> </li>  <li class="page-item disabled"><a class="page-link" href="?page=' . ($page - 1) . '" title="Previous page">Previous</a></li>' ;
    
        // The "forward" link
        $nextlink = ($page < $pages) ? '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '" title="Next page">Next</a></li>   <li class="page-item"><a class="page-link" href="?page=' . $pages . '" title="Last page">&raquo;</a></li>' : '<li class="page-item disabled"><a class="page-link" href="?page=' . ($page + 1) . '" title="Next page">Next</a></li>   <li class="page-item disabled"><a class="page-link" href="?page=' . $pages . '" title="Last page">&raquo;</a></li>';
    
        // Display the paging information
        
    
        
        $new_query = $query."				
            LIMIT
                :limit
            OFFSET
                :offset";
        // Prepare the paged query
        $stmt = $this->conn->prepare($new_query);
        // Bind the query params
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $page_options="";
        for($i=1; $i<=$pages; $i++){         
            if($i == $this->page){
                $page_options.= "<option selected value=".$i.">".$i."</option>";
            }
            else{
                $page_options.= "<option value=".$i.">".$i."</option>";
            }
        }
        $page_select='<select onchange="gotoPage(event)">'.$page_options.'</select>';
        $this->paginationcode =  '<nav ><ul class="pagination justify-content-center">'. $prevlink. '<li class="page-item"><p class="page-link"> Page '. $page_select. ' of '. $pages.  $nextlink. '</p></li> </ul></nav>';
        return $stmt->fetchAll();
    
        
    
    }
    
    public function getPagination(){
        return $this->paginationcode;
    }
}    