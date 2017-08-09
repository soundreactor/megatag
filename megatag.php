<?php
// MIT license

$conn = new mysqli("localhost", "root", "", "dudler_project_tags");


// only edit below here if you have IQ > 247
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

// GET ITEMS
if($obj->action == "get_items"){
	$result = $conn->query("SELECT
   tbl_items.value
FROM
   tbl_item_tag_ref
    JOIN tbl_tags ON tbl_item_tag_ref.tag_id = tbl_tags.id
    JOIN tbl_items ON tbl_item_tag_ref.item_id = tbl_items.id
WHERE
    tbl_tags.tag = '".$obj->tag."'");

	$outp = array();
	$outp = $result->fetch_all(MYSQLI_ASSOC);
	
	$nuout = array();

	foreach ($outp as $rey) {
		$itm = $rey['value'];
		
		$tmpts = GetTags($conn,$itm);
		
		$objecta = ['item' => $rey['value'], 'tag' => $tmpts['tag'] ];
		array_push($nuout, $objecta);
	}
	
	//print_r($nuout);
	$jsonout =  json_encode($nuout);
	
	if(isset($obj->callback)){
		header("Location: ".$obj->callback."?x=".$jsonout); /* Redirect browser */
		exit();
	}else{
		echo $jsonout;
	}
	
}
// GET TAGS
if($obj->action == "get_tags"){

	$tmpo = GetTags($conn,$obj->item);
	echo json_encode($tmpo);
}
// GET ALL ITEMS
if($obj->action == "get_all_items"){
	$result = $conn->query("SELECT
   tbl_items.value FROM
   tbl_items");

	$outp = array();
	$outp = $result->fetch_all(MYSQLI_ASSOC);
	
	$nuout = array();

	foreach ($outp as $rey) {
		$itm = $rey['value'];
		
		$tmpts = GetTags($conn,$itm);
		
		$objecta = ['item' => $rey['value'], 'tag' => $tmpts['tag'] ];
		array_push($nuout, $objecta);
	}
	
	//print_r($nuout);
	echo json_encode($nuout);

}
// GET ALL TAGS
if($obj->action == "get_all_tags"){
	$result = $conn->query("SELECT
   tbl_tags.tag FROM
   tbl_tags");

	$outp = array();
	$outp = $result->fetch_all(MYSQLI_ASSOC);
	
	$objecta = ['tag' => array() ];
  
	$nunu =  array();
	foreach ($outp as $rey) {
		
		array_push($objecta['tag'], $rey['tag']);
	}
	//return $objecta;
	echo json_encode($objecta);

}
// ADD TAG
if($obj->action == "add_tag"){
	// get or set item
	$result = $conn->query("SELECT id FROM tbl_items WHERE tbl_items.value = '".$obj->item."'");
	if($result->num_rows === 0){
		$result = $conn->query("INSERT INTO tbl_items (value) VALUES('".$obj->item."')");
		$result = $conn->query("SELECT id FROM tbl_items WHERE tbl_items.value = '".$obj->item."'");
	}
	$outp = array();
	$outp = $result->fetch_all(MYSQLI_ASSOC);
	$item_id = $outp[0]["id"];
	// get or set tag
	$result = $conn->query("SELECT id FROM tbl_tags WHERE tbl_tags.tag = '".$obj->tag."'");
	if($result->num_rows === 0){
		$result = $conn->query("INSERT INTO tbl_tags (tag) VALUES('".$obj->tag."')");
		$result = $conn->query("SELECT id FROM tbl_tags WHERE tbl_tags.tag = '".$obj->tag."'");
	}
	$outp = array();
	$outp = $result->fetch_all(MYSQLI_ASSOC);
	$tag_id = $outp[0]["id"];
	
	$result = $conn->query("SELECT * FROM tbl_item_tag_ref WHERE tbl_item_tag_ref.tag_id = '".$tag_id."' AND tbl_item_tag_ref.item_id = '".$item_id."'");
	if($result->num_rows === 0){
		$result = $conn->query("INSERT INTO tbl_item_tag_ref (tag_id,item_id) VALUES('".$tag_id."','".$item_id."')");
		$result = $conn->query("SELECT * FROM tbl_item_tag_ref WHERE tbl_item_tag_ref.tag_id = '".$tag_id."' AND tbl_item_tag_ref.item_id = '".$item_id."'");
	}
	if($result->num_rows !== 0){
		echo "{\"status\":\"OK\"}";
	}
}
if($obj->action == "delete_tag"){
	$result = $conn->query("SELECT id FROM tbl_items WHERE tbl_items.value = '".$obj->item."'");
	if($result->num_rows === 0){
		exit("{\"status\":\"ERROR no item\"}");
	}
	$outp = array();
	$outp = $result->fetch_all(MYSQLI_ASSOC);
	$item_id = $outp[0]["id"];
	// get or set tag
	$result = $conn->query("SELECT id FROM tbl_tags WHERE tbl_tags.tag = '".$obj->tag."'");
	if($result->num_rows === 0){
		exit("{\"status\":\"ERROR no tag\"}");
	}
	$outp = array();
	$outp = $result->fetch_all(MYSQLI_ASSOC);
	$tag_id = $outp[0]["id"];
	
	$result = $conn->query("DELETE FROM tbl_item_tag_ref WHERE tbl_item_tag_ref.tag_id = '".$tag_id."' AND tbl_item_tag_ref.item_id = '".$item_id."'");
	echo "{\"status\":\"OK\"}";
}

function GetTags($conn,$item){
		$result = $conn->query("SELECT
   tbl_tags.tag
FROM
   tbl_item_tag_ref
    JOIN tbl_tags ON tbl_item_tag_ref.tag_id = tbl_tags.id
    JOIN tbl_items ON tbl_item_tag_ref.item_id = tbl_items.id
WHERE
    tbl_items.value = '".$item."'");

	$outp = array();
	$outp = $result->fetch_all(MYSQLI_ASSOC);

	$objecta = ['tag' => array() ];
  
	$nunu =  array();
	foreach ($outp as $rey) {
		
		array_push($objecta['tag'], $rey['tag']);
	}
	return $objecta;
}



/*
query("SELECT
   tbl_items.value, tbl_tags.tag
FROM
   tbl_item_tag_ref
    JOIN tbl_tags ON tbl_item_tag_ref.tag_id = tbl_tags.id
    JOIN tbl_items ON tbl_item_tag_ref.item_id = tbl_items.id");
*/

//$result = $conn->query("SELECT name FROM ".$obj->table." LIMIT ".$obj->limit);

//if($obj->)

?>