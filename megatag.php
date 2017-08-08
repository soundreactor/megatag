<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$conn = new mysqli("localhost", "root", "", "dudler_project_tags");


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

	echo json_encode($outp);
}
// GET TAGS
if($obj->action == "get_tags"){
	$result = $conn->query("SELECT
   tbl_tags.tag
FROM
   tbl_item_tag_ref
    JOIN tbl_tags ON tbl_item_tag_ref.tag_id = tbl_tags.id
    JOIN tbl_items ON tbl_item_tag_ref.item_id = tbl_items.id
WHERE
    tbl_items.value = '".$obj->item."'");

	$outp = array();
	$outp = $result->fetch_all(MYSQLI_ASSOC);

	echo json_encode($outp);
}
// GET ALL
if($obj->action == "get_all"){
	$result = $conn->query("SELECT
   tbl_items.value, tbl_tags.tag
FROM
   tbl_item_tag_ref
    JOIN tbl_tags ON tbl_item_tag_ref.tag_id = tbl_tags.id
    JOIN tbl_items ON tbl_item_tag_ref.item_id = tbl_items.id");

	$outp = array();
	$outp = $result->fetch_all(MYSQLI_ASSOC);
	
	$nunu =  array();
	foreach ($outp as $rey) {
		$nunu = array_merge_recursive($rey,$nunu);
	}
	//$nunu = array_unique ($nunu);
	//$outp = array_merge_recursive($outp);
	//print_r($result);

	echo json_encode( $nunu);
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
//$result = $conn->query("SELECT name FROM ".$obj->table." LIMIT ".$obj->limit);

//if($obj->)

?>