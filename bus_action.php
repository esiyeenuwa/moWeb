<?php
	include("gen.php");
	$cmd=get_datan("cmd");//get datan makes sure that the browser does not show any responses
	//echo "are u called";
	switch($cmd){
		case 1:
			//gets all the child welfare details including the fullname
			report();
			break;
		case 2:
			//adds a new child welfare detail
			add_gcDetail();
			break;
		case 3:
			//updates any chances made to the child welfare detail
			update_gChild();
			break;
		case 4:
			//deletes a child welfare detail
			filter();
			break;
		case 5:
			//searches all people with a paticular detail
			search();
			break;
		case 6:
		//get the number of sick children
			report_gc();
			break;
		default:
			echo "{";
			echo jsonn("result",0). ",";
			echo jsons("message","unknown command");
			echo "}";
	}
	
	

	function report(){
	
		include ("bus_functions.php");
		$vs=get_data("vs");
		$obj=new bus();
		$row=$obj->report($vs);
		
		if(!$row)
			{
			echo'{"result":0,"message":"Unable to retrive report"}';
			return;
			}
			$row=$obj->fetch();
			echo "{";
			echo '"num":[';
			while( $row){
					
			echo "{";
			echo jsonn("result",1). ",";
			//echo '"gChild":[{';
			echo jsonn("number",$row['number'] );
		
			echo "}";
			
			$row=$obj->fetch();
			if($row){
				echo ",";
			}

		}
		echo "]";
			echo "}";
		
	}
		
	//add a new child welfaredetail
	function add_gcDetail(){
		$id= get_datan('id');
		$vh= get_datan('vh');
		$vw=get_datan('vw');
		$vs=get_data('vs');
		
		//echo "let it goo";
		if(!$id){
		//display message
			echo'{"result":0,"message":"Unable to add. Non-exsisting hospitail ID"}';
		return;
		}
		include ("growing_child.php");
			$g=new growing_child();
		if(!$g->add_gcDetail($id,$vh,$vw,$vs))
		{
		echo'{"result":0,"message":"Unable to add"}';
		return;
		}
		echo'{"result":1,"message":"One item has sucessfully been add"}';
	}
	
	//updates an changes in the child welfare detail
	function update_gChild(){
		$id= get_datan('id');
		$vh= get_datan('vh');
		$vw=get_datan('vw');
		$vs=get_data('vs');
		$vc=get_datan('vc');
		
		if(!$id){
		//display message
			echo'{"result":0,"message":"not working"}';
		return;
		}
		include ("growing_child.php");
			$g=new growing_child();
		if(!$g->update_gcDetails($id,$vc,$vh,$vw,$vs))
		{
		echo'{"result":0,"message":"unable to update"}';
		return;
		}
		echo'{"result":1,"message":"One item has sucessfully been updated successfully"}';
	}
	
	//deletes a child welfare detail
	//function del_gDetail(){
	//	$id= get_datan('id');

		//echo "let it goo";
	//	if(!$id){
		//display message
		//echo'{"result":0,"message":"not working"}';
		//return;
		//}
		//include ("growing_child.php");
		//$g=new growing_child();
		//if(!$g->delete_gcDetail($id))
		//{
		//echo'{"result":0,"message":"unable to delete"}';
		//return;
		//}
		//echo'{"result":1,"message":"One item has sucessfully been deleted"}';
	//}
	
	//searches for a child welfare detail
	function search(){
	//creates an object of the growing class
		include("bus_functions.php");
		$vs=get_data("vs");
                
                $obj = new bus();
			
			//calls the querry that shows the details of a child
			$row=$obj->search($vs);
	
			if(!$row){
			echo "{";
			echo jsonn("result",0). ",";
			echo jsons("message","Details not found");
			echo "}";
			return;
		}
				
			echo "{";
			echo jsonn("result",1). ",";
			echo '"person":[{';
			echo jsons("name",$row['name'] ).",";
			echo jsons("username",$row['username']).",";
			echo jsonn("ticketid",$row['ticketid']).",";
			echo jsons("date",$row['date']).",";
			echo jsonn("facultyId",$row['facultyId']);
			echo "}]";
		echo "}";
	}
	
		function filllter(){
	//creates an object of the growing class
		include("bus_functions.php");
		$vs=get_data("vs");
                
                $obj = new bus();
			
			//calls the querry that shows the details of a child
			$row=$obj->filter($vs);
	
			if(!$row){
			echo "{";
			echo jsonn("result",0). ",";
			echo jsons("message","Details not found");
			echo "}";
			return;
		}
				
			echo "{";
			echo jsonn("result",1). ",";
			echo '"person":[{';
			echo jsons("name",$row['name'] ).",";
			echo jsons("username",$row['username']).",";
			echo jsonn("ticketid",$row['ticketid']).",";
			echo jsons("date",$row['date']).",";
			echo jsonn("facultyId",$row['facultyId']);
			echo "}]";
		echo "}";
	}
	
			function filter(){
	//creates an object of the growing class
		include("bus_functions.php");
		$vs=get_data("vs");
                
                $obj = new bus();
			
			//calls the querry that shows the details of a child
			$row=$obj->filter($vs);
	
			if(!$row){
			echo "{";
			echo jsonn("result",0). ",";
			echo jsons("message","Details not found");
			echo "}";
			return;
		}
				
		$row=$obj->fetch();
			echo "{";
			echo '"person":[';
			while( $row){
					
			echo "{";
			echo jsonn("result",1). ",";
			//echo '"gChild":[{';
			echo jsons("name",$row['name'] ).",";
			echo jsons("username",$row['username']).",";
			echo jsonn("ticketid",$row['ticketid']).",";
			echo jsons("date",$row['date']).",";
			echo jsonn("facultyId",$row['facultyId']);
		
			echo "}";
			
			$row=$obj->fetch();
			if($row){
				echo ",";
			}

		}
		echo "]";
			echo "}";
	}
	//get the number of sick children
	function report_gc(){
	
		include ("growing_child.php");
		
		$obj=new growing_child();
		$row=$obj->number_sick();
	
		if(!$row)
			{
			echo'{"result":0,"message":"Unable to retrive report"}';
			return;
			}
		echo "{";
			echo jsonn("count",$row['number']);		
		echo "}";
	}
?>