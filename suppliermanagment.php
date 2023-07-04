<?php
include('connect.php');
include('functions.php');
?>
<html dir="<?php echo $header['direction']; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $header['siteName']; ?></title>

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" /> <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="./lib/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="./lib/bootstrap/bootwatch.css" rel="stylesheet" />
    <link href="index.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <!DOCTYPE html>





</head>

<body>
    <?php
    include('header.php');
    ?>



    <div class="container">
        <div class="bg-dark p-2">

            <!-- Button trigger modal -->
            <div style="margin-top: 20px;">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsupplierModal">
                    <?php if ($header['langname'] == 'Ar') echo 'جديد';
                    else if ($header['langname'] == 'En') echo 'New Supplier' ?>
                </button>

                <button href="JavaScript:void(0);" id="delete_multiple" class="btn btn-danger">
                    <?php if ($header['langname'] == 'Ar') echo 'حذف';
                    else if ($header['langname'] == 'En') echo 'Delete' ?>
                </button>


                <div class="text-light m-2">
                    <table id="tblUser" class="table bg-light table-bordered">
                        <thead>

                            <th> <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"> <?php if ($header['langname'] == 'Ar') echo 'الكل';
                                                            else if ($header['langname'] == 'En') echo 'All' ?></label>
                                </span></th>
                            <th>#</th>
                            <th><?php if ($header['langname'] == 'Ar') echo 'اسم المورد';
                                else if ($header['langname'] == 'En') echo 'Supplier Name' ?></th>
                            <th><?php if ($header['langname'] == 'Ar') echo 'الصورة';
                                else if ($header['langname'] == 'En') echo 'Image' ?></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `suppliers`";
                            $result = mysqli_query($connect, $sql);
                            $i = 1;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr id="<?php echo $row["id"]; ?>">

                                    <td>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" class="user_checkbox" data-categories-id="<?php echo $row["id"]; ?>">
                                            <label for="checkbox2"></label>
                                        </span>
                                    </td>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php if ($header['langname'] == 'Ar') echo $row['name'];
                                        else if ($header['langname'] == 'En') echo $row['nameEn'] ?></td>
                                    <td> <img src="images/suppliers/<?php echo $row['image'] ?>" width="50px" height="50px" alt=""> </td>
                                    <td>

                                        <a href="#" class="update btn btn-primary" data-toggle="modal" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-nameEn="<?php echo $row['nameEn'] ?>" data-addressAr="<?php echo $row['address'] ?>" data-addressEn="<?php echo $row['addressEn'] ?>" data-countryAr="<?php echo $row['country'] ?>" data-countryEn="<?php echo $row['countryEn'] ?>" data-cityAr="<?php echo $row['city'] ?>" data-cityEn="<?php echo $row['cityEn'] ?>" data-domain="<?php echo $row['domain'] ?>" data-phone="<?php echo $row['phone'] ?>" data-mobile="<?php echo $row['mobile'] ?>" data-email="<?php echo $row['email'] ?>" data-longitude="<?php echo $row['longitude'] ?>" data-latitude="<?php echo $row['latitude'] ?>" data-image="<?php echo $row['image'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="#" class="delete btn btn-danger" data-id="<?php echo $row["id"]; ?>" data-toggle="modal"><i class="bi bi-trash-fill"></i></a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>


                <!-- Add Modal -->
                <div class="modal fade" id="addsupplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" enctype="multipart/form-data" id="supplier_form">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'اسم المورد';
                    else if ($header['langname'] == 'En') echo 'Supplier Name' ?></label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'اسم المورد';
                    else if ($header['langname'] == 'En') echo 'Supplier Name' ?> (Ar)" class="form-control" type="text" name="suppliernameAr" id="suppliernameAr" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'اسم المورد';
                    else if ($header['langname'] == 'En') echo 'Supplier Name' ?> (En)" class="form-control" type="text" name="suppliernameEn" id="suppliernameEn" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'العنوان';
                    else if ($header['langname'] == 'En') echo 'Address' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'العنوان';
                    else if ($header['langname'] == 'En') echo 'Address' ?> (Ar)" class="form-control" type="text" name="addressAr" id="addressAr" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'العنوان';
                    else if ($header['langname'] == 'En') echo 'Address' ?> (En)" class="form-control" type="text" name="addressEn" id="addressEn" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'البلد';
                    else if ($header['langname'] == 'En') echo 'Country' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'البلد';
                    else if ($header['langname'] == 'En') echo 'Country' ?> (Ar)" class="form-control" type="text" name="countryAr" id="countryAr" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'البلد';
                    else if ($header['langname'] == 'En') echo 'Country' ?> (En)" class="form-control" type="text" name="countryEn" id="countryEn" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'المدينة';
                    else if ($header['langname'] == 'En') echo 'City' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'المدينة';
                    else if ($header['langname'] == 'En') echo 'City' ?> (Ar)" class="form-control" type="text" name="cityAr" id="cityAr" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'المدينة';
                    else if ($header['langname'] == 'En') echo 'City' ?> (En)" class="form-control" type="text" name="cityEn" id="cityEn" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'عنوان موقع ويب المورد';
                    else if ($header['langname'] == 'En') echo 'Web site URL' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'عنوان موقع ويب المورد';
                    else if ($header['langname'] == 'En') echo 'Web site URL' ?>" class="form-control" type="url" name="domain" id="domain" value="">

                                    </div>


                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'رقم الهاتف';
                    else if ($header['langname'] == 'En') echo 'Phone' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'رقم الهاتف';
                    else if ($header['langname'] == 'En') echo 'Phone' ?>" class="form-control" type="text" name="phone" id="phone" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'رقم الموبايل';
                    else if ($header['langname'] == 'En') echo 'Mobile' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'رقم الموبايل';
                    else if ($header['langname'] == 'En') echo 'Mobile' ?>" class="form-control" type="text" name="mobile" id="mobile" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'البريد الإلكتروني';
                    else if ($header['langname'] == 'En') echo 'Email' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'البريد الإلكتروني';
                    else if ($header['langname'] == 'En') echo 'Email' ?>" class="form-control" type="email" name="email" id="email" value="">

                                    </div>



                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'احداثيات خط الطول';
                    else if ($header['langname'] == 'En') echo 'Longitude' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'احداثيات خط الطول';
                    else if ($header['langname'] == 'En') echo 'Longitude' ?>" class="form-control" type="text" name="longitude" id="longitude" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'احداثيات خط العرض';
                    else if ($header['langname'] == 'En') echo 'Latitude' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'احداثيات خط العرض';
                    else if ($header['langname'] == 'En') echo 'Latitude' ?>" class="form-control" type="text" name="latitude" id="latitude" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'صورة';
                    else if ($header['langname'] == 'En') echo 'Image' ?></label>
                                        <input type="file" id="supplierimage" name="supplierimage" class="form-control">

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="1" name="type">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php if ($header['langname'] == 'Ar') echo 'إغلاق';
                    else if ($header['langname'] == 'En') echo 'Close' ?></button>
                                    <button type="submit" id="btn-add" class="btn btn-primary"><?php if ($header['langname'] == 'Ar') echo 'حفظ';
                    else if ($header['langname'] == 'En') echo 'Save' ?></button>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>


                <!-- Edit Modal -->
                <div class="modal fade" id="editsupplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" enctype="multipart/form-data" id="update_form">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="id_u" name="id" class="form-control" required>
                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'اسم المورد';
                    else if ($header['langname'] == 'En') echo 'Supplier Name' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'اسم المورد';
                    else if ($header['langname'] == 'En') echo 'Supplier Name' ?> (Ar)" class="form-control" type="text" name="suppliernameAr" id="suppliernameAr_u" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'اسم المورد';
                    else if ($header['langname'] == 'En') echo 'Supplier Name' ?> (En)" class="form-control" type="text" name="suppliernameEn" id="suppliernameEn_u" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'العنوان';
                    else if ($header['langname'] == 'En') echo 'Address' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'العنوان';
                    else if ($header['langname'] == 'En') echo 'Address' ?> (Ar)" class="form-control" type="text" name="addressAr" id="addressAr_u" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'العنوان';
                    else if ($header['langname'] == 'En') echo 'Address' ?> (En)" class="form-control" type="text" name="addressEn" id="addressEn_u" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'البلد';
                    else if ($header['langname'] == 'En') echo 'Country' ?>  </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'البلد';
                    else if ($header['langname'] == 'En') echo 'Country' ?>  (Ar)" class="form-control" type="text" name="countryAr" id="countryAr_u" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'البلد';
                    else if ($header['langname'] == 'En') echo 'Country' ?>  (En)" class="form-control" type="text" name="countryEn" id="countryEn_u" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'المدينة';
                    else if ($header['langname'] == 'En') echo 'City' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'المدينة';
                    else if ($header['langname'] == 'En') echo 'City' ?> (Ar)" class="form-control" type="text" name="cityAr" id="cityAr_u" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'المدينة';
                    else if ($header['langname'] == 'En') echo 'City' ?> (En)" class="form-control" type="text" name="cityEn" id="cityEn_u" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'عنوان موقع ويب المورد';
                    else if ($header['langname'] == 'En') echo 'Web site URL' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'عنوان موقع ويب المورد';
                    else if ($header['langname'] == 'En') echo 'Web site URL' ?>" class="form-control" type="url" name="domain" id="domain_u" value="">

                                    </div>


                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'رقم الهاتف';
                    else if ($header['langname'] == 'En') echo 'Phone' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'رقم الهاتف';
                    else if ($header['langname'] == 'En') echo 'Phone' ?>" class="form-control" type="text" name="phone" id="phone_u" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'رقم الموبايل';
                    else if ($header['langname'] == 'En') echo 'Mobile' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'رقم الموبايل';
                    else if ($header['langname'] == 'En') echo 'Mobile' ?>" class="form-control" type="text" name="mobile" id="mobile_u" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'البريد الإلكتروني';
                    else if ($header['langname'] == 'En') echo 'Email' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'البريد الإلكتروني';
                    else if ($header['langname'] == 'En') echo 'Email' ?>" class="form-control" type="email" name="email" id="email_u" value="">

                                    </div>



                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'احداثيات خط الطول';
                    else if ($header['langname'] == 'En') echo 'Longitude' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'احداثيات خط الطول';
                    else if ($header['langname'] == 'En') echo 'Longitude' ?>" class="form-control" type="text" name="longitude" id="longitude_u" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'احداثيات خط العرض';
                    else if ($header['langname'] == 'En') echo 'Latitude' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'احداثيات خط العرض';
                    else if ($header['langname'] == 'En') echo 'Latitude' ?>" class="form-control" type="text" name="latitude" id="latitude_u" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'صورة';
                    else if ($header['langname'] == 'En') echo 'Image' ?></label>

                                    </div>


                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'صورة';
                    else if ($header['langname'] == 'En') echo 'Image' ?></label>
                                        <img id="Image_u" width="50px" height="50px">
                                        <input type="hidden" name="hidden_user_image" id="hidden_user_image_u">

                                        <input type="file" id="supplierimage_u" name="supplierimage" class="form-control">

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="2" name="type">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php if ($header['langname'] == 'Ar') echo 'إغلاق';
                    else if ($header['langname'] == 'En') echo 'Close' ?></button>
                                    <button type="submit" id="update" class="btn btn-primary"><?php if ($header['langname'] == 'Ar') echo 'حفظ';
                    else if ($header['langname'] == 'En') echo 'Save' ?></button>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- end edit modal -->

                <!-- Delete modal -->
                <div id="deleteSupplierModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <h4 class="modal-title"><?php if ($header['langname'] == 'Ar') echo 'حذف مورد';
                                else if ($header['langname'] == 'En') echo 'Delete Supplier' ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="id_d" name="id" class="form-control">
                                    <p><?php if ($header['langname'] == 'Ar') echo 'هل أنت متأكد من عملية الحذف؟';
                                else if ($header['langname'] == 'En') echo 'Are you sure you want to delete this Record?' ?></p>
                                    <p class="text-warning"><small><?php if ($header['langname'] == 'Ar') echo 'لا يمكن التراجع عن عملية الحذف.';
                                else if ($header['langname'] == 'En') echo 'This action cannot be undone.' ?></small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php if ($header['langname'] == 'Ar') echo 'إغلاق';
                                else if ($header['langname'] == 'En') echo 'Close' ?></button>

                                    <button type="submit" class="btn btn-danger" id="delete"><?php if ($header['langname'] == 'Ar') echo 'حذف';
                                else if ($header['langname'] == 'En') echo 'Delete' ?></button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>



</body>
<?php include('footer.php') ?>
<script>
    jQuery(document).ready(function($) {
        $('#tblUser').DataTable({
            language: {
                info: "<?php if ($header['langname'] == 'Ar') echo 'عرض الصفحة رقم _PAGE_ من _PAGES_';
                        else if ($header['langname'] == 'En') echo 'Showing page _PAGE_ of  _PAGES_' ?>",
                lengthMenu: "<?php if ($header['langname'] == 'Ar') echo 'عرض _MENU_ سجلات بكل صفحة ';
                                else if ($header['langname'] == 'En') echo 'Display _MENU_ records per page' ?>"
                                ,
                paginate: {
                    next: "<?php if ($header['langname'] == 'Ar') echo 'التالي';else if ($header['langname'] == 'En') echo 'Next' ?>",
                    previous: "<?php if ($header['langname'] == 'Ar') echo 'السابق';else if ($header['langname'] == 'En') echo 'Previous' ?>",
                },
                search: "<?php if ($header['langname'] == 'Ar') echo 'البحث';
                            else if ($header['langname'] == 'En') echo 'Search' ?>",

                searchPlaceholder: "<?php if ($header['langname'] == 'Ar') echo 'ابحث هنا';
                                    else if ($header['langname'] == 'En') echo 'Search for' ?>",


            }
        });

    });

    $(document).on('submit', '#supplier_form', function(event) {
        event.preventDefault();
        var suppliernameAr = $('#suppliernameAr').val();
        var suppliernameEn = $('#suppliernameEn').val();
        var addressAr = $('addressAr').val();
        var addressEn = $('addressEn').val();
        var countryAr = $('countryAr').val();
        var countryEn = $('countryEn').val();
        var cityAr = $('cityAr').val();
        var cityEn = $('cityEn').val();
        var domain = $('domain').val();
        var phone = $('phone').val();
        var mobile = $('mobile').val();
        var email = $('email').val();
        var longitude = $('longitude').val();
        var latitude = $('latitude').val();




        var extension = $('#supplierimage').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#supplierimage').val('');
                return false;
            }
        }
        if (suppliernameAr != '' && suppliernameEn != '') {
            $.ajax({
                url: "supplier_save.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode == 200) {
                        $('#addsupplierModal').modal('hide');
                        alert('Data added successfully !');
                        location.reload();
                    } else if (dataResult.statusCode == 201) {
                        alert(dataResult);
                    }

                }
            });
        } else {
            alert("Both Fields are Required");
        }
    });

    $(document).on("click", ".delete", function() {
        var id = $(this).attr("data-id");
        $('#id_d').val(id);

        $('#deleteSupplierModal').modal('show');


    });





    $(document).on("click", "#delete", function() {
        $.ajax({
            url: "supplier_save.php",
            type: "POST",
            cache: false,
            data: {
                type: 3,
                id: $("#id_d").val()
            },
            success: function(dataResult) {
                $('#deleteSupplierModal').modal('hide');
                $("#" + dataResult).remove();

            }
        });
    });


    $(document).on("click", "#delete_multiple", function() {
        var categories = [];
        $(".user_checkbox:checked").each(function() {
            categories.push($(this).data('categories-id'));
        });
        if (categories.length <= 0) {
            alert("Please select records.");
        } else {
            WRN_PROFILE_DELETE = "Are you sure you want to delete " + (categories.length > 1 ? "these" : "this") + " row?";
            var checked = confirm(WRN_PROFILE_DELETE);
            if (checked == true) {
                var selected_values = categories.join(",");
                console.log(selected_values);
                $.ajax({
                    type: "POST",
                    url: "supplier_save.php",
                    cache: false,
                    data: {
                        type: 4,
                        id: selected_values
                    },
                    success: function(response) {
                        var ids = response.split(",");
                        for (var i = 0; i < ids.length; i++) {
                            $("#" + ids[i]).remove();
                        }
                    }
                });
            }
        }
    });
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function() {
            if (this.checked) {
                checkbox.each(function() {
                    this.checked = true;
                });
            } else {
                checkbox.each(function() {
                    this.checked = false;
                });
            }
        });
        checkbox.click(function() {
            if (!this.checked) {
                $("#selectAll").prop("checked", false);
            }
        });
    });

    $(document).on('click', '.update', function(e) {
        $('#editsupplierModal').modal('show');

        var id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var nameEn = $(this).attr("data-nameEn");
        var addressAr = $(this).attr("data-addressAr");
        var addressEn = $(this).attr("data-addressEn");
        var countryAr = $(this).attr("data-countryAr");
        var countryEn = $(this).attr("data-countryEn");
        var cityAr = $(this).attr("data-cityAr");
        var cityEn = $(this).attr("data-cityEn");
        var domain = $(this).attr("data-domain");
        var phone = $(this).attr("data-phone");
        var mobile = $(this).attr("data-mobile");
        var email = $(this).attr("data-email");
        var longitude = $(this).attr("data-longitude");
        var latitude = $(this).attr("data-latitude");

        var image = $(this).attr("data-image");
        $('#id_u').val(id);
        $('#suppliernameAr_u').val(name);
        $('#suppliernameEn_u').val(nameEn);
        $('#addressAr_u').val(addressAr);
        $('#addressEn_u').val(addressEn);
        $('#countryAr_u').val(countryAr);
        $('#countryEn_u').val(countryEn);
        $('#cityAr_u').val(cityAr);
        $('#cityEn_u').val(cityEn);
        $('#domain_u').val(domain);
        $('#phone_u').val(phone);
        $('#mobile_u').val(mobile);
        $('#email_u').val(email);
        $('#longitude_u').val(longitude);
        $('#latitude_u').val(latitude);

        $("#Image_u").attr("src", "images/suppliers/" + image);
        $('#hidden_user_image_u').val(image);
    });


    $(document).on('submit', '#update_form', function(event) {
        event.preventDefault();
        var suppliernameAr = $('#suppliernameAr_u').val();
        var suppliernameEn = $('#suppliernameEn_u').val();
        var addressAr = $('addressAr_u').val();
        var addressEn = $('addressEn_u').val();
        var countryAr = $('countryAr_u').val();
        var countryEn = $('countryEn_u').val();
        var cityAr = $('cityAr_u').val();
        var cityEn = $('cityEn_u').val();
        var domain = $('domain_u').val();
        var phone = $('phone_u').val();
        var mobile = $('mobile_u').val();
        var email = $('email_u').val();
        var longitude = $('longitude_u').val();
        var latitude = $('latitude_u').val();

        var extension = $('#supplierimage_u').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#supplierimage_u').val('');
                return false;
            }
        }
        if (suppliernameAr != '' && suppliernameEn != '') {
            $.ajax({
                url: "supplier_save.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode == 200) {
                        $('#editsupplierModal').modal('hide');
                        alert('Data updated successfully !');
                        location.reload();
                    } else if (dataResult.statusCode == 201) {
                        alert(dataResult);
                    }

                }
            });
        } else {
            alert("Both Fields are Required");
        }
    });
</script>

</html>