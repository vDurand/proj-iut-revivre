<?php
	$pageTitle = "Sélection des plannings";
	$pwd='../';
	include($pwd."bandeau.php");

	$listeTypesPlanning = mysqli_query($db, "SELECT PL_id, PL_Libelle FROM typeplanning");
?>
<div id="corps">
	<div id="labelT">
		<label>Sélection des plannings</label>
	</div>
	<div class="planning-filters">
		<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
			<table>
				<thead>
					<tr>
						<th colspan="4">Filtres :</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="selectType" style="width:200px">
								<select name="PL_id">
									<option value="null" selected="selected" disabled="disabled">Choisissez un type</option>
									<?php
										while($data = mysqli_fetch_assoc($listeTypesPlanning))
										{
											echo '<option value="'.$data["PL_id"].'">'.$data["PL_Libelle"].'</option>';
										}
									?>
								</select>
							</div>
						</td>
						<td>
							<div class="selectType" style="width:200px">
								<select name="ASSOC_Date" disabled="disabled">
									<option value="null" selected="selected" disabled="disabled">Choisissez une date</option>
								</select>
							</div>
						</td>
						<td>
							<div class="selectType" style="width:200px">
								<select name="ENC_Num" disabled="disabled">
									<option value="null" selected="selected" disabled="disabled">Choisissez un encadrant</option>
								</select>
							</div>
						</td>
						<td>
							<input type="checkbox"/>
							<label>N'afficher que les archives</label>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<hr class="hr-stylized" />
	<div class="planning-table waiting-planning">
		<div class="planning-loader">
			<object data="<?php echo $pwd; ?>images/loader.svg" type="image/svg+xml"></object>
			<label>En attente de sélection d'un planning...</label>
		</div>
<!-- 		<table>
	<thead>
		<tr>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Lundi</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Mardi</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Mercredi</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Jeudi</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Vendredi</td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table> -->
	</div>
</div>
<?php
	include($pwd."footer.php");
?>