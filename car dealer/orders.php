<?php
ob_start();
session_start();
require_once 'server/model/Enum.php';
require_once 'server/CarDealerDAO.php';
require_once 'server/CarDAO.php';
require_once 'server/DiagramDAO.php';
require_once 'server/model/CarDealer.php';
require_once 'server/model/Paging.php';

$num_cars = null;
$rowCarField = null;


if (!isset($_SESSION['carDealerUsername'])) {
    header('Location: sign-in.php');
} else {
    $p = new Paging();
    define('RECORDS_PER_PAGE', 5);
    $p->setRecordsPerPage(RECORDS_PER_PAGE);
    $p->setPageQueryStr('rowNumber');
    $p->setStartingRow($p->getPageRowNumber());

    $q = new CarDealerDAO();
    $carDealer_data = $q->getCarDealerByUsername($_SESSION['carDealerUsername']);

    $v = new CarDAO();
    $all_cars = $v->getAllCars();
    $num_cars = $v->countAllCars();
    $rowCarField = $v->getCarsLimitByRecPerPage($p->getStartingRow(), $p->getRecordsPerPage());

    // adding general car info
    if (!empty($_POST['add-car-submit'])) {
        $isAddedCondition = $v->isCreated($_POST);
    }

    // displaying a car photos for deletion  with ajax
    $d = new DiagramDAO();
    if (isset($_GET['action'])) {
        if ($_GET['action'] === "getPhotosByCarId") {
            $diagram = $d->getPhotosBy_CarId($_GET['id']);
            $diagramJson = json_encode($diagram);
            echo $diagramJson; // sent to ajax don't remove
            exit();
        }
    }

    // deleting a car photo
    if (isset($_GET["action"])) {
        if ($_GET["action"] === "deleteCarPhoto") {
            $isDeletedPhoto = $d->isDeleted($_GET["id"]);
        }
    }

    $canRead = $canUpdate = $canInsert = $canDelete = 'true';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Primary Meta Tags -->
    <title>Car Shopping Project</title>
    <meta name="title" content="Car Shopping Project">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Car Shopping Project">
    <meta property="og:description" content="">
    <meta property="og:image" content="homePage.PNG"/>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo_main.css">
	<link rel="stylesheet" href="css/datatables.min.css">
</head>
<body>
<div id="main-wrapper">
    <div class="loader"></div>
    <div class="template-page-wrapper">
        <div class="templatemo-content-wrapper">
            <div class="templatemo-content">
                <ol class="breadcrumb">
                    <li class="active">Manage Orders</li>
                </ol>
                <input type="text" class="hidden" id="carDealer-username" name="carDealer-username" title="carDealer id"
                       value="<?php echo $carDealer_data[0]->getUsername(); ?>">
                <h1>Manage Orders</h1>
                <?php if (isset($isAddedCondition) && $isAddedCondition === 1) { ?>
                    <div class="loader show"></div>
                    <?php header("refresh: 1; url=inventory.php");
                } ?>
                <?php if (isset($isDeletedPhoto) && $isDeletedPhoto === 1) { ?>
                    <div class="loader show"></div>
                    <?php header("refresh: 1; url=inventory.php");
                } ?>
                <?php if (isset($isUpdatedCondition) && $isUpdatedCondition === 1) { ?>
                    <div class="loader show"></div>
                    <?php header("refresh: 1; url=inventory.php");
                } ?>
                <!-- car table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="vehicle-table" class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Price ($)</th>
                                    <th>Customer's Name</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php


require_once('config.php');
    $stmt = $conn->prepare("Select customerorder.customerorderId ,vehicle.yearMade,vehicle.make,vehicle.model,vehicle.price,customer.username,customerorder.address,customerorder.status from vehicle inner join customerorder on customerorder.vehicleId=vehicle.vehicleId inner join customer on customer.customerId=customerorder.customerId Where vehicle.cardealerId=".$carDealer_data[0]-> getCarDealerId());
    $stmt->execute(); 
    $stmt->bind_result($customerorderId,$yearMade,$make,$model,$price,$name,$address,$status);
    while ($stmt->fetch()) { ?>

        <tr>
                                        <td><?php echo $yearMade; ?></td>
                                        <td><?php echo $make;?></td>
                                        <td><?php echo $model; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-xs dropdown-toggle" type="button"
                                                        data-toggle="dropdown">Actions
                                                    <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <?php if ($canUpdate == 'true') { ?>
                                                    <li>
                                                        <a href="accept_order.php?updateId=<?php echo $customerorderId; ?>">Accept</a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php if ($canDelete == 'true') { ?>
                                                        <li>
                                                        <a href="reject_order.php?updateId=<?php echo $customerorderId; ?>">Reject</a>
                                                    </li>
                                                    <?php } ?>
                                                    
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
        <?php }  ?>


                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example" class="<?php if($num_cars <= $p->getRecordsPerPage()) {echo 'hidden';} ?>">
                                <ul class="pagination">
                                    <?php if($num_cars > $p->getRecordsPerPage()) { ?>
                                        <?php if($p->getPrev() >= 0) { ?>
                                            <li class="page-item"><a href="inventory.php?rowNumber=<?php echo $p->getPrev(); ?>">Previous</a></li>
                                        <?php } ?>
                                        <?php $pageNumber = 1; ?>
                                        <?php for($i = 0; $i < $num_cars; $i = $i + $p->getRecordsPerPage()) { ?>
                                            <?php if($i != $p->getStartingRow()) { ?>
                                                <li class="page-item"><a href="inventory.php?rowNumber=<?php echo $i; ?>"><?php echo $pageNumber; ?></a></li>
                                            <?php } else { ?>
                                                <li class="page-item active"><a href="inventory.php?rowNumber=<?php echo $i; ?>"><?php echo $pageNumber; ?></a></li>
                                            <?php } ?>
                                            <?php $pageNumber = $pageNumber + 1; ?>
                                        <?php } ?>
                                        <?php if($p->getNext() < $num_cars) { ?>
                                            <li class="page-item"><a href="inventory.php?rowNumber=<?php echo $p->getNext(); ?>">Next</a></li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>

                


            </div>
        </div>
    </div>

    <!-- modal template for uploading and updating photos -->
    <?php if ($canUpdate == 'true') { ?>
    <div class="modal fade bs-example-modal-sm" id="upload-delete-car-photos-modal" tabindex="-1"
         role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Upload or Delete Photos for this Vehicle</h4>
                </div>
                <div class="row">
                    <div class="col-md-12 margin-top-15">
                        <div class="col-md-12">
                            <div class="panel panel-warning">
                                <div class="panel-heading">Deleting photos...</div>
                                <div class="panel-body" id="display-images-by-this-car"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form id="add-car-photos-form" enctype="multipart/form-data">
                            <div class="panel panel-info">
                                <div class="panel-heading">Upload photos for this car</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><b>Note</b>: Only image file types are allowed to be
                                                uploaded, otherwise it will not work.</p>
                                            <input type="file" id="files" name="files[]" multiple/>
                                            <output id="list"></output>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" name="upload-car-photos-btn" value="Submit" carid="null" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

</div>
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/datatables.min.js"></script>

<script src="js/common/CommonTemplate.js"></script>
<script src="js/common/CarDealerPageTemplate.js"></script>
<script src="js/common/CommonUtil.js"></script>
<script src="js/routine/common-html.js"></script>
<script src="js/routine/car-actions.js"></script>
<script src="js/app.js"></script>

<script src="js/common/AddOrUpdateTemplate.js"></script>
<script type="text/javascript">
  let carDealerAddCar = new AddOrUpdateTemplate('null');
  let addCarContainerDiv = $('#addCarContainer');
  addCarContainerDiv.empty();
  addCarContainerDiv.append(carDealerAddCar.addOrUpdateCar_Container());

  function previewSelectedImages(evt) {
    let files = evt.target.files; // FileList object
    // Loop through the FileList and render image files as thumbnails.
    for (let i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      let reader = new FileReader();
      // Closure to capture the file information.
      reader.onload = (function (theFile) {
        return function (e) {
          // Render thumbnail.
          let span = document.createElement('span');
          span.innerHTML = ['<img model="thumb" id="car-image-' + i + '" src="', e.target.result,
            '" title="', theFile.name, '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }
  document.getElementById('files').addEventListener('change', previewSelectedImages, false);
</script>

</body>
</html>