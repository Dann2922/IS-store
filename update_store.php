<!-- Bootstrap -->
<meta charset="utf-8" />
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <?php
		include_once("connection.php");
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
			$result = pg_query($Connect, "SELECT * FROM public.store WHERE storeid = '$id'");
			$row = pg_fetch_array($result);
			$store_id = $row["storeid"];
			$store_name = $row["storename"];
			$store_add = $row["storeadd"];
			$store_hotline = $row["hotline"];
		?>
     	<div class="container">
     		<h2 align="center">Updating Store</h2>
     		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
     			<div class="form-group">
     				<label for="txtID" class="col-sm-2 control-label">Store ID: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Catepgy ID" readonly value='<?php echo $store_id; ?>'>
     				</div>
     			</div>
     			<div class="form-group">
     				<label for="txtName" class="col-sm-2 control-label">Store Name: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Catepgy Name" value='<?php echo $store_name ?>'>
     				</div>
     			</div>

     			<div class="form-group">
     				<label for="txtDesc" class="col-sm-2 control-label">Address: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txtadd" id="txtadd" class="form-control" placeholder="Address" value='<?php echo $store_add ?>'>
     				</div>
     			</div>

                 <div class="form-group">
     				<label for="txtDesc" class="col-sm-2 control-label">Hotline: </label>
     				<div class="col-sm-10">
     					<input type="text" name="txthotline" id="txthotline" class="form-control" placeholder="Hotline" value='<?php echo $store_hotline ?>'>
     				</div>
     			</div>

     			<div class="form-group">
     				<div class="col-sm-offset-2 col-sm-10">
     					<input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
     					<input type="button" class="btn btn-primary" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location='?page=store_management'" />

     				</div>
     			</div>
     		</form>
     	</div>
     	<?php
			if(isset($_POST["btnUpdate"])) {
				$id = $_POST["txtID"];
				$name = $_POST["txtName"];
				$add = $_POST["txtadd"];
                $hotline = $_POST["txthotline"];
				$err = "";
				if ($name == "") {
					$err . "<li>Enter Store Name, please</li>";
				}
				if ($err != "") {
					echo "<ul>$err</ul>";
				} else {
					$sq = "SELECT * FROM public.store WHERE storeid != '$id' and storename = '$name'";
					$result = pg_query($Connect, $sq);
					if (pg_num_rows($result) == 0) {
						pg_query($Connect, "UPDATE public.store SET storename = '$name', storeadd = '$add', hotline = '$hotline' WHERE storeid = '$id'");
						echo '<meta http-equiv="refresh" content = "0; ?page=store_management"/>';
					} else {
						echo "<li>Dulicate Store Name</li>";
					}
				}
			}
			?>
     <?php
		} else {
			echo '<meta http-equiv="refresh" content = "0; ?page=store_management"/>';
		}
		?>