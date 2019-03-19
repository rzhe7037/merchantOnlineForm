<?php include_once('./header.php') ?>
<?php include_once('./models/search_shops.php') ?>
<?php include_once('./models/preload_options.php') ?>
<?php include_once("session_checker.php")?>



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready( function () {
    $('#result').DataTable({
        searching: false,
        "columnDefs": [ 
        {
            "targets": -1,
            "orderable": false
        } 
        ]
    });
} );
</script>
<style>
    .btn a{
        color: white;
    }
    *{
        color: #505458;
        padding: 0px;
        font-size: 14px;
    }
    .input-group-text{
        color: #17a2b8;
        border-style: none;
        margin: 1px;
        line-height:1;
        padding-bottom: 0px;
        background-color: white;
        justify-content: flex-start !important;
        
    }
    .input-group input{
        outline: 0;
        border-width: 0 0 1px;
        border-color: black;
        width: 40%;
        border-radius: 0;
    }
    .field{
        width: 40%;
    }
    .input{
        width: 40%;
    }
    .submit{
        border-radius: 1em;
    }


    .panel-body{
        padding: 4px;
    }
  

    .form-inline input[type='checkbox']  {
        height: 30px;
    }
    .panel label{
        width: 48%;
        
    }
    .panel select,.panel input[type="text"]{
        width: 50% !important;
    }
    .panel{
        border: 1px solid grey;
        box-shadow: 5px 5px 18px #888888;
    }  
    .panel-header{
        background-color: #212529;
        color: #ffffff;
        padding: 5px;
    }      



</style> 

    <?php
        // collect result for export
        $rows_export = [];  
        $index = 0;
        foreach($rows as $row){
            $row_export=[];
            $row_export["id"] =  $index;
            $row_export["Tradding name"] = $row['trading_name'];
            $address_street = ($row['address_postcode'] == 0 && empty($row['address_suburb']) && empty($row['address_state']) )? 'Not given' :$row['address_street']." ".$row['address_suburb']." ".$row['address_postcode']." ".$row['address_state'];
            $row_export["Address"] = $address_street;          
            
            foreach($attributes as $key => $value){
                if($value == "active"){
                    $row_export[$key]=$row[$key];
                }
            }
            

            array_push($rows_export,$row_export);
            $index ++; 
        }  
        $rows_export_json = json_encode($rows_export);          
    ?>
    <script>
        var exportData = <?php echo $rows_export_json; ?>;
        function convertArrayOfObjectsToCSV(args) {
            var result, ctr, keys, columnDelimiter, lineDelimiter, data;

            data = args.data || null;
            if (data == null || !data.length) {
                return null;
            }

            columnDelimiter = args.columnDelimiter || ',';
            lineDelimiter = args.lineDelimiter || '\n';

            keys = Object.keys(data[0]);

            result = '';
            result += keys.join(columnDelimiter);
            result += lineDelimiter;

            data.forEach(function(item) {
                ctr = 0;
                keys.forEach(function(key) {
                    if (ctr > 0) result += columnDelimiter;

                    result += item[key];
                    ctr++;
                });
                result += lineDelimiter;
            });

            return result;
        }

        function downloadCSV(args) {
            var data, filename, link;

            var csv = convertArrayOfObjectsToCSV({
                data: exportData
            });
            if (csv == null) return;

            filename = args.filename || 'export.csv';

            if (!csv.match(/^data:text\/csv/i)) {
                
                csv = 'data:text/csv;charset=UTF-8,' + '\uFEFF' + csv;
            }
            data = encodeURI(csv);

            link = document.createElement('a');
            link.setAttribute('href', data);
            link.setAttribute('download', filename);
            link.click();
        }
    </script>



    <div class="container">
        <h5 class="my-3">View shops</h5>
        <form method="POST" action="./session_storage.php">
            <div class="row">
                <!--Filter Area-->
                <div class="col-sm-6" >                    
                    <div class="panel">
                    <div class="panel-header">
                        <i class="fa fa-search"></i>Search
                    </div>       
                    <div class="panel-body">            
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Company Name</label>
                            <input class="form-control" name="company_name" type="text"/>
                        </div>
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Business Type</label>
                            <select name="business_type" class="custom-select" onchange="updateSubType()" id="business_type">
                                <?php print_r($business_types)?>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Business Subype</label>
                            <select name="business_subtype" class="custom-select" id="business_subtype">
                            </select>
                        </div>
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Nationality</label>
                            <select name="nationality" class="custom-select">
                                <?php print_r ($nationalitys)?>
                            </select>
                        </div>    

                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Street name</label>
                            <input class="form-control" name="address_street"  type="text"/>
                        </div>        
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Suburb</label>
                            <select name="address_suburb" class="custom-select">
                                <?php print_r ($suburbs)?>
                            </select>
                        </div> 
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Owner Name</label>
                            <input class="form-control" name="owner_name"  type="text"/>
                        </div> 
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Owner Mobile</label>
                            <input class="form-control" name="owner_mobile"  type="text"/>
                        </div>                    
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Pos</label>
                            <select name="pos" class="custom-select">
                                <?php print_r ($poses)?>
                            </select>
                        </div>    
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Qr payment</label>    
                            <select name="QR_payment" class="custom-select">
                                <?php print_r($payments_options);?>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Satisfaction</label>
                            <select class="custom-select" id="satisfaction" name="satisfaction">
                                <option value="">--select--</option>
                                <option value="Poor">Poor</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Satisfied">Satisfied</option>
                                <option value="Very satisfied">Very satisfied</option>
                            </select>
                        </div>   
                        <button class=" btn btn-dark m-3" type="button" onclick="clearinputs(); clearoptions();">
                            Clear
                        </button>    
                    </div>
                    </div>
                </div>


                <!--Attribute Select Area-->
                <div class="col-sm-6">    
                          
                    <div class="panel">
                    <div class="panel-header">
                        <i class="fas fa-check"></i>Select attribute
                    </div>  
                    <div class="panel-body">

                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Business Type</label>
                            <input type="checkbox" value="true" name="attribute_business_type">
          
    
                        </div>
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Business Subtype </label>
                            <input type="checkbox" value="true" name="attribute_business_subtype"> 
               
                        </div>

                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Nationality</label>
                            <input type="checkbox" value="true" name="attribute_nationality"> 
            
                        </div>



                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Street name</label>
                            <input type="checkbox" value="true" name="attribute_address_street">
                
                        </div>

                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Suburb</label>
                            <input type="checkbox" value="true" name="attribute_address_suburb">           
                        </div>

                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Owner Name</label>
                            <input  type="checkbox" value="true" name="attribute_owner_name">            
                        </div>

                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Owner Mobile</label>
                            <input  type="checkbox" value="true" name="attribute_owner_mobile">
                        </div>

                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Pos</label>
                            <input  type="checkbox" value="true" name="attribute_pos">
                        </div>
    
                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">QR payment</label>
                            <input  type="checkbox" value="true" name="attribute_QR_payment">
                        </div>

                        <div class="form-inline">
                            <label class="input-group-text" for="inputGroupSelect01">Satisfaction</label>
                            <input  type="checkbox" value="true" name="attribute_satisfaction">
                        </div>
                                                 
                        <button class="btn btn-dark m-3" type="button" onclick="clearcheckboxs()">
                            Clear
                        </button>
                    </div>
                    </div>
                </div>

               
            </div>      
            <div class="row">
                <button class="btn btn-dark my-3 mx-3 ml-3 ml-auto submit" style="display:block;" onclick="clearinputs();clearoptions();clearcheckboxs()">Clear All</button>
                <button class="btn btn-dark my-3 mx-3 ml-3 submit" type="submit" style="display:block;">Go</button>
                <div class="btn btn-dark my-3 mx-3 ml-3 submit" style="display:block;" onclick='downloadCSV({ filename: "shopinfo-export-data.csv" });' data-toggle="tooltip" data-placement="top" title="依据以下表格生成CSV文件">Export results as csv</div>
            </div>
	
        </form>

        <table class="table table-striped table-hover" id="result">
            <thead>
                <tr>
                    <?php 
                        $table_header="<th>id</th><th>Shop name</th><th>Address</th>";
                        foreach($attributes as $key => $value){
                            if($value == "active"){
                                $table_header.="<th>".$key."</th>";
                            }
                        }
                        $table_header.="<th>Action</th>";
                        echo $table_header;
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php $pageGet = isset($_GET['page']) ? "&&page=".$_GET['page']:"" ?>
                <?php 
                    $index=0;
                    foreach ($rows as $row){
                        // Check whether address is empty
                        $address_street = ($row['address_postcode'] == 0 && empty($row['address_suburb']) && empty($row['address_state']) )? 'Not given' :$row['address_street']." ".$row['address_suburb'].", ".$row['address_postcode']." ".$row['address_state'];
                        $table_rows="<tr><td>".($index+$pagination->limit*($pagination->page-1))."</td><td class='text-primary' onclick='openNewTabView(".$row['company_id'].")'>".$row['trading_name']."</td>"."<td>".$address_street."</td>";
                        foreach($attributes as $key => $value){
                            if($value == "active"){
                                $table_rows.="<td>".$row[$key]."</td>";
                            }
                        }
                        
                        $table_rows.="<td><button onclick='openNewTabEdit(".$row['company_id'].")' class='btn btn-info'>Edit</td></tr>";
                        echo $table_rows;
                        $index ++;                                  
                    }
                ?>
            </tbody>

        </table>  
        <div class=row>
            <?php echo "<div class='btn btn-primary my-3 mx-3 ml-auto'><a href='/ShopInfo/pages/main.php'>Back</a></div>";?>
        <div>
      


        <script>
        
            // remember value in form
            var inputs = document.getElementsByTagName('input');
            var selects = document.getElementsByTagName('select');
            var session = JSON.parse('<?php echo json_encode($_SESSION["post-data"]);?>');
            for(var i = 0; i < inputs.length; i++) {
                if(inputs[i].type.toLowerCase() == 'checkbox') {
                    if(session[inputs[i].name]=="true"){
                        inputs[i].checked = true;
                    }                                
                }
                else if(inputs[i].type.toLowerCase() == 'text') {
                    inputs[i].value = session[inputs[i].name];                           
                }
            }

            for(var i = 0; i < selects.length; i++) {
                if(session[selects[i].name] != ""){
                    var select = selects[i];
                    var options = select.children;
                    for(var j = 0; j < options.length; j++){
                        if(options[j].value==session[selects[i].name]){
                            options[j].selected = true;
                            break;
                        }
                    }
                }    
                                         
            }

        </script>
        <script>
            function updateSubType() {
                var business_type = document.getElementById('business_type').value;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById('business_subtype').innerHTML = xhttp.responseText;
                    }
                };
                xhttp.open("GET", "/ShopInfo/pages/models/fetch_business_subtype.php?business_type=" + business_type, true);
                xhttp.send();

            }
            function clearinputs(){
                var inputs = document.getElementsByTagName('input');
                for(var i = 0; i < inputs.length; i++) {                    
                    inputs[i].value = "";                                               
                }
            }

            function clearoptions(){
                var selects = document.getElementsByTagName('select');
                for(var i = 0; i < selects.length; i++) {
                    var options = selects[i].children;                    
                    for(var j = 0; j < options.length; j++) {
                        options[j].selected = false;
                    }                                                
                }
            }

            function clearcheckboxs(){
                var inputs = document.getElementsByTagName('input');
                for(var i = 0; i < inputs.length; i++) {                    
                    if(inputs[i].type.toLowerCase() == 'checkbox') {
                        inputs[i].checked = false;
                    }                                           
                }
            }

            function gotoPage(e){

                window.location.href = '/ShopInfo/pages/view.php?page='+e.target.value;
            }

            function openNewTabView(company_id){

                window.open('/ShopInfo/pages/view_single.php?company_id='+company_id, '_blank');
            }

            function openNewTabEdit(company_id){

                window.open('/ShopInfo/pages/edit.php?company_id='+company_id, '_blank');
            }


        </script>

</div>

