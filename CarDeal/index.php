<?php
include_once './common/init.php';
$keyword = get_arg('keyword');

$where = '';
if($keyword){
    $where = " where make.BRAND_NAME like '%$keyword%' or model.MODEL_NAME like '%$keyword%' or color.COLOR_NAME like '%$keyword%' ";
}

$sql = "SELECT car.VIN_NUM, make.BRAND_NAME, model.MODEL_NAME, trim.TRIM_NAME, car.`YEAR`, 
color.COLOR_NAME, fuel_type.FUEL_TYPE_NAME, transmission.TRANSM_TYPE_NAME, 
`condition`.RATING_NAME, car.NUM_DOORS, car.NUM_CYLINDERS, car.`RANGE`, car.PRICE FROM car 
LEFT JOIN model on car.CAR_MODEL_ID = model.CAR_MODEL_ID
LEFT JOIN make on make.CAR_BRAND_ID = model.CAR_BRAND_ID
LEFT JOIN trim on car.TRIM_ID = trim.TRIM_ID
LEFT JOIN color on car.COLOR_ID = color.COLOR_ID
LEFT JOIN fuel_type on car.FUEL_ID = fuel_type.FUEL_ID
LEFT JOIN transmission on car.TRANSMISSION_ID = transmission.TRANSMISSION_ID
LEFT JOIN `condition` on car.CONDT_ID = `condition`.CONDT_ID ".$where;

$cars = $sqlhelp->get_rows($sql);

?>
<?php include_once "./common/html_header.php"; ?>
<?php include_once "./common/html_nav.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <form action="index.php" method="get" class="form-inline">
                    <div class="form-group">
                        <label for="keyword">Keyword:</label>
                        <input type="text" class="form-control" id="keyword" name="keyword" value="<?php echo $keyword;?>" placeholder="search brand/model/color ">
                    </div>
                    <button type="submit" class="btn btn-default">search</button>
                </form>
                <hr>
                <table class="table table-bordered table-striped responsive-utilities">
                    <thead>
                    <tr>
                        <th>VIN NUM</th>
                        <th>BRAND</th>
                        <th>MODEL</th>
                        <th>TRIM</th>
                        <th>YEAR</th>
                        <th>COLOR</th>
                        <th>FUEL TYPE</th>
                        <th>TRANSM TYPE</th>
                        <th>DETAIL</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?php echo $car['VIN_NUM']; ?></td>
                            <td><?php echo $car['BRAND_NAME']; ?></td>
                            <td><?php echo $car['MODEL_NAME']; ?></td>
                            <td><?php echo $car['TRIM_NAME']; ?></td>
                            <td><?php echo $car['YEAR']; ?></td>
                            <td><?php echo $car['COLOR_NAME']; ?></td>
                            <td><?php echo $car['FUEL_TYPE_NAME']; ?></td>
                            <td><?php echo $car['TRANSM_TYPE_NAME']; ?></td>
                            <td><a href="detail.php?VIN_NUM=<?php echo $car['VIN_NUM']; ?>">DETAIL</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include_once "./common/html_footer.php"; ?>