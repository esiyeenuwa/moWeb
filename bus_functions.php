<?php

	include_once("adb.php");
	
	class bus extends adb{
	
		function bus(){
		adb::adb();
		}
		
	//display all

	function display_all(){

		$query="select * from vitamins ";
		if(!$this->query($query)){return false;}
		return $this->query($query);
		
	}
        function list_today(){
            
           $query="select distinct users.username,dropofflocation.name, ticketid ,reservation.date from reservation, dropofflocation, users where dropofflocation.doid=reservation.doid and users.facultyId=reservation.facultyId and reservation.date=CURDATE()";
           if(!$this->query($query))
               {return false;}
		return $this->query($query);
        }
		function reserve_num(){
		           $query="select distinct count(*) as reserveNum from reservation, dropofflocation, users where dropofflocation.doid=reservation.doid and users.facultyId=reservation.facultyId and reservation.date=CURDATE()";
				   if(!$this->query($query)){return false;}
		return $this->query($query);
	
		}
        
		
        	//allows for data entry
		 function reserve($name,$date,$destination,$ticketid,$status){
			return $this->query("insert into reservation(date,doid,ticketid,Status,facultyId) 
		  values('$date','$destination','$ticketid','$status','$name')");
		}
        
	function validateId($facultyId){

		$query="select count(*) as number from users where facultyId='$facultyId'";
		if(!$this->query($query)){return false;}
		return $this->query($query);
		
	}
	
	function accBalance($facultyId){

		$query="select account from users where facultyId='$facultyId'";
		if(!$this->query($query)){return false;}
		return $this->query($query);
		
	}
	
	//a query to search for childeren with a particular name
		function search($name){
		$query="select distinct users.username,dropofflocation.name, reservation.facultyId, ticketid ,reservation.date from reservation, dropofflocation, users where dropofflocation.doid=reservation.doid and users.facultyId=reservation.facultyId and users.username like'%$name%' order by date desc";
			
			if(!$this->query($query)){
				return false;
			}
			return $this->fetch();
			
		}
		
	
		//a query to search for childeren with a particular name
		function filter($name){
		$query="select distinct users.username,dropofflocation.name, reservation.facultyId, ticketid ,reservation.date from reservation, dropofflocation, users where dropofflocation.doid=reservation.doid and users.facultyId=reservation.facultyId and date='$name' order by date desc";
			
			if(!$this->query($query)){
				return false;
			}
			return $this->query($query);
			
		}
		
		
		function report($date){

		$query="select distinct facultyId as number from reservation where reservation.date='$date'";
		if(!$this->query($query)){
		return false;
			}
		return $this->query($query);
	 
	}

        //update
	
	function update_vitamin($id,$v_name,$quantity){
	
	$query =" update vitamins set v_name ='$v_name', quantity= $quantity where v_id=$id ";
	
	if(!$this->query($query))
	{
		return false;
	}
	
		return $this->query($query);
	
	
	}
	
	
		


}

?>