<?php include 'includes/header.php'; ?>
<?php



$id=$_POST['id']; 
$page=$_POST['page']; 

if(isset($_POST['Delete']) && !$errors)
{
echo "<div class='successPopup'>Text Box Deleted.</div>";
mysql_query("DELETE FROM html WHERE id='$id' ") ;  
}

if(isset($_POST['Addtomenu']) && !$errors)
{
echo "<div class='successPopup'>Added to menu.</div>";
mysql_query("UPDATE html SET active='1' WHERE id='$id'") ;  
}

if(isset($_POST['Addto']) && !$errors)
{
echo "<div class='successPopup'>Update Successful!</div>";
mysql_query("UPDATE html SET page='$page' WHERE id='$id' ") ;  
}

if(isset($_POST['Removefrommenu']) && !$errors)
{
echo "<div class='successPopup'>Removed from menu.</div>";
mysql_query("UPDATE html SET active='0' WHERE id='$id'") ;  
}

$data = mysql_query("SELECT * FROM html ") 
or die(mysql_error()); 

?>

<div class="col100">
<h1>HTML Boxes</h1>
</div>

<div class="colFull">

<ul id="adminList">	

<?php while($info = mysql_fetch_array( $data )) { ?>
		<li>
			<span class="adminHeading"><?php Print $info['name']; ?></span><br />
			<a class="redButton" href="edit-html.php?id=<?php Print $info['id']; ?>">
				Edit
			</a>

			
			<?php if ($info['active'] == 0)
				{
					echo '<form class="addtomenu" name="update" method="post" enctype="multipart/form-data" action="">
					<input type="hidden" name="id" value="'.$info["id"].'" >
					<input type="hidden" name="active" value="1" >
					<input name="Addtomenu" type="submit" value="Add to Client Menu">
					</form>';
				}
			else
				{
					echo '<form class="addtomenu" name="update" method="post" enctype="multipart/form-data" action="">
					<input type="hidden" name="id" value="'.$info["id"].'" >
					<input type="hidden" name="active" value="0" >
					<input name="Removefrommenu" type="submit" value="Remove from menu">
					</form>';
				}			
			?>				
			
			<?php
			echo '<form name="delete" method="post" enctype="multipart/form-data" action="">
			<input type="hidden" name="id" value="'.$info["id"].'" >
			<input name="Delete" type="submit" value="Delete">
			</form>';
			?>
			
				
			
			<?php
					echo '<br /><form name="addto" method="post" enctype="multipart/form-data" action="">
					<input type="hidden" name="id" value="'.$info["id"].'" >
					<label>Pages</label><br />
					<input type="text" name="page" value="'.$info["page"].'" ><br />
					<input name="Addto" type="submit" value="Update">
					</form>';
			?>			
			
<br clear="all" />
			<span class="include">To add this to your website template, please paste the following code:<br />
			<b>&lt;?php $id=<?php echo $info['id']; ?>; include('craigms/includes/single-html.php'); ?&gt;</b></span>
		</li>
<?php } ?>
<li><a style="color: #666; font-weight: normal;" href="new-html.php?posttype=page">+ Add New HTML Box</a></li>
</ul>
</div>

<?php include 'includes/footer.php'; ?>