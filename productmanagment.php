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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproductModal">
                    <?php if ($header['langname'] == 'Ar') echo 'جديد';
                    else if ($header['langname'] == 'En') echo 'New Product' ?>
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
                                    <label for="selectAll">
                                        <?php if ($header['langname'] == 'Ar') echo 'الكل';
                                        else if ($header['langname'] == 'En') echo 'All' ?>
                                    </label>
                                </span></th>
                            <th>#</th>
                            <th><?php if ($header['langname'] == 'Ar') echo 'اسم المنتج';
                                else if ($header['langname'] == 'En') echo 'Product Name' ?></th>
                            <th><?php if ($header['langname'] == 'Ar') echo 'السعر';
                                else if ($header['langname'] == 'En') echo 'Price' ?></th>
                            <th><?php if ($header['langname'] == 'Ar') echo 'الفئة';
                                else if ($header['langname'] == 'En') echo 'Category' ?></th>
                            <th><?php if ($header['langname'] == 'Ar') echo 'المورد';
                                else if ($header['langname'] == 'En') echo 'Supplier' ?></th>
                            <th><?php if ($header['langname'] == 'Ar') echo 'الصورة';
                                else if ($header['langname'] == 'En') echo 'Image' ?></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `products`";
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
                                    <td><?php echo $row['price'] ?></td>
                                    <td><?php
                                        $catid = $row['category_id'];
                                        $sqlcat = mysqli_query($connect, "SELECT * FROM `categories` where `id` = '$catid'");
                                        $cat = mysqli_fetch_assoc($sqlcat);
                                        if ($header['langname'] == 'Ar')
                                            echo $cat['name'];
                                        else if ($header['langname'] == 'En')
                                            echo $cat['nameEn'];
                                        ?></td>
                                    <td>
                                        <?php
                                        $supid = $row['supplier_id'];
                                        $sqlsup = mysqli_query($connect, "SELECT * FROM `suppliers` where `id` = '$supid'");
                                        $sup = mysqli_fetch_assoc($sqlsup);
                                        if ($header['langname'] == 'Ar')
                                            echo $sup['name'];
                                        else if ($header['langname'] == 'En')
                                            echo $sup['nameEn'];

                                        ?></td>

                                    <td> <img src="images/products/<?php echo $row['image'] ?>" width="50px" height="50px" alt=""> </td>
                                    <td>

                                        <a href="#" class="update btn btn-primary" data-toggle="modal" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-nameEn="<?php echo $row['nameEn'] ?>" data-description="<?php echo $row['description'] ?>" data-descriptionEn="<?php echo $row['descriptionEn'] ?>" data-addressAr="<?php echo $row['address'] ?>" data-addressEn="<?php echo $row['addressEn'] ?>" data-countryAr="<?php echo $row['country'] ?>" data-countryEn="<?php echo $row['countryEn'] ?>" data-cityAr="<?php echo $row['city'] ?>" data-cityEn="<?php echo $row['cityEn'] ?>" data-price="<?php echo $row['price'] ?>" data-supplier_id="<?php echo $row['supplier_id'] ?>" data-category_id="<?php echo $row['category_id'] ?>" data-image="<?php echo $row['image'] ?>">
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
                <div class="modal fade" id="addproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" enctype="multipart/form-data" id="product_form">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'اسم المنتج';
                    else if ($header['langname'] == 'En') echo 'Product Name' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'اسم المنتج';
                    else if ($header['langname'] == 'En') echo 'Product Name' ?> (Ar)" class="form-control" type="text" name="productnameAr" id="productnameAr" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'اسم المنتج';
                    else if ($header['langname'] == 'En') echo 'Product Name' ?> (En)" class="form-control" type="text" name="productnameEn" id="productnameEn" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'وصف المنتج';
                    else if ($header['langname'] == 'En') echo 'Description' ?> </label>
                                        <textarea placeholder="<?php if ($header['langname'] == 'Ar') echo 'وصف المنتج';
                    else if ($header['langname'] == 'En') echo 'Description' ?> (Ar)" class="form-control" type="text" name="descriptionAr" id="descriptionAr"></textarea>
                                        <textarea placeholder="<?php if ($header['langname'] == 'Ar') echo 'وصف المنتج';
                    else if ($header['langname'] == 'En') echo 'Description' ?> (En)" class="form-control" type="text" name="descriptionEn" id="descriptionEn"></textarea>

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'الفئة';
                    else if ($header['langname'] == 'En') echo 'Category' ?> </label>

                                        <select class="form-select" id="categoryList" name="categoryList">
                                            <?php
                                            $sqlCategory = "SELECT * FROM `categories`";
                                            $resultCategory = mysqli_query($connect, $sqlCategory);

                                            while ($rowCategory = mysqli_fetch_array($resultCategory)) {
                                            ?>
                                                <option value="<?php echo $rowCategory['id'] ?>"><?php if ($header['langname'] == 'Ar') echo $rowCategory['name'];
                                                                                                    else if ($header['langname'] == 'En') echo $rowCategory['nameEn'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'المورد';
                    else if ($header['langname'] == 'En') echo 'Supplier' ?> </label>

                                        <select class="form-select" id="supplierList" name="supplierList">
                                            <?php
                                            $sqlsuppliers = "SELECT * FROM `suppliers`";
                                            $resultsuppliers = mysqli_query($connect, $sqlsuppliers);

                                            while ($rowsuppliers = mysqli_fetch_array($resultsuppliers)) {
                                            ?>
                                                <option value="<?php echo $rowsuppliers['id'] ?>"><?php if ($header['langname'] == 'Ar') echo $rowsuppliers['name'];
                                                                                                    else if ($header['langname'] == 'En') echo $rowsuppliers['nameEn'] ?></option>
                                            <?php } ?>
                                        </select>
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
                                        <label><?php if ($header['langname'] == 'Ar') echo 'السعر';
                    else if ($header['langname'] == 'En') echo 'Price' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'السعر';
                    else if ($header['langname'] == 'En') echo 'Price' ?>" class="form-control" type="number" name="price" id="price" value="">

                                    </div>




                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'صورة';
                    else if ($header['langname'] == 'En') echo 'Image' ?></label>
                                        <input type="file" id="productimage" name="productimage" class="form-control">

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
                <div class="modal fade" id="editproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" enctype="multipart/form-data" id="update_form">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="id_u" name="id" class="form-control" required>
                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'اسم المنتج';
                    else if ($header['langname'] == 'En') echo 'Product Name' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'اسم المنتج';
                    else if ($header['langname'] == 'En') echo 'Product Name' ?> (Ar)" class="form-control" type="text" name="productnameAr" id="productnameAr_u" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'اسم المنتج';
                    else if ($header['langname'] == 'En') echo 'Product Name' ?> (En)" class="form-control" type="text" name="productnameEn" id="productnameEn_u" value="">

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'وصف المنتج';
                    else if ($header['langname'] == 'En') echo 'Description' ?> </label>
                                        <textarea placeholder="<?php if ($header['langname'] == 'Ar') echo 'وصف المنتج';
                    else if ($header['langname'] == 'En') echo 'Description' ?> (Ar)" class="form-control" type="text" name="descriptionAr" id="descriptionAr_u"></textarea>
                                        <textarea placeholder="<?php if ($header['langname'] == 'Ar') echo 'وصف المنتج';
                    else if ($header['langname'] == 'En') echo 'Description' ?> (En)" class="form-control" type="text" name="descriptionEn" id="descriptionEn_u"></textarea>

                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'الفئة';
                    else if ($header['langname'] == 'En') echo 'Category' ?> </label>

                                        <select class="form-select" id="categoryList_u" name="categoryList">
                                            <?php
                                            $sqlCategory = "SELECT * FROM `categories`";
                                            $resultCategory = mysqli_query($connect, $sqlCategory);

                                            while ($rowCategory = mysqli_fetch_array($resultCategory)) {
                                            ?>
                                                <option value="<?php echo $rowCategory['id'] ?>"><?php if ($header['langname'] == 'Ar') echo $rowCategory['name'];
                                                                                                    else if ($header['langname'] == 'En') echo $rowCategory['nameEn'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'المورد';
                    else if ($header['langname'] == 'En') echo 'Supplier' ?> </label>

                                        <select class="form-select" id="supplierList_u" name="supplierList">
                                            <?php
                                            $sqlsuppliers = "SELECT * FROM `suppliers`";
                                            $resultsuppliers = mysqli_query($connect, $sqlsuppliers);

                                            while ($rowsuppliers = mysqli_fetch_array($resultsuppliers)) {
                                            ?>
                                                <option value="<?php echo $rowsuppliers['id'] ?>"><?php if ($header['langname'] == 'Ar') echo $rowsuppliers['name'];
                                                                                                    else if ($header['langname'] == 'En') echo $rowsuppliers['nameEn'] ?></option>
                                            <?php } ?>
                                        </select>
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
                    else if ($header['langname'] == 'En') echo 'Country' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'البلد';
                    else if ($header['langname'] == 'En') echo 'Country' ?> (Ar)" class="form-control" type="text" name="countryAr" id="countryAr_u" value="">
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'البلد';
                    else if ($header['langname'] == 'En') echo 'Country' ?> (En)" class="form-control" type="text" name="countryEn" id="countryEn_u" value="">

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
                                        <label><?php if ($header['langname'] == 'Ar') echo 'السعر';
                    else if ($header['langname'] == 'En') echo 'Price' ?> </label>
                                        <input placeholder="<?php if ($header['langname'] == 'Ar') echo 'السعر';
                    else if ($header['langname'] == 'En') echo 'Price' ?>" class="form-control" type="number" name="price" id="price_u" value="">

                                    </div>






                                    <div class="form-group">
                                        <label>Image</label>

                                    </div>


                                    <div class="form-group">
                                        <label><?php if ($header['langname'] == 'Ar') echo 'صورة';
                    else if ($header['langname'] == 'En') echo 'Image' ?></label>
                                        <img id="Image_u" width="50px" height="50px">
                                        <input type="hidden" name="hidden_user_image" id="hidden_user_image_u">

                                        <input type="file" id="productimage_u" name="productimage" class="form-control">

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
                <div id="deleteproductModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <h4 class="modal-title"><?php if ($header['langname'] == 'Ar') echo 'حذف منتج';
                                else if ($header['langname'] == 'En') echo 'Delete Product' ?></h4>
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

                    next: "<?php if ($header['langname'] == 'Ar') echo 'التالي';
                            else if ($header['langname'] == 'En') echo 'Next' ?>",
                    previous: "<?php if ($header['langname'] == 'Ar') echo 'السابق';
                                else if ($header['langname'] == 'En') echo 'Previous' ?>"
                },
                search: "<?php if ($header['langname'] == 'Ar') echo 'البحث';
                            else if ($header['langname'] == 'En') echo 'Search' ?>",

                searchPlaceholder: "<?php if ($header['langname'] == 'Ar') echo 'ابحث هنا';
                                    else if ($header['langname'] == 'En') echo 'Search for' ?>",


            }
        });    });

    $(document).on('submit', '#product_form', function(event) {
        event.preventDefault();
        var productnameAr = $('#productnameAr').val();
        var productnameEn = $('#productnameEn').val();
        var descriptionAr = $('#descriptionAr').val();
        var descriptionEn = $('#descriptionEn').val();
        var addressAr = $('addressAr').val();
        var addressEn = $('addressEn').val();
        var countryAr = $('countryAr').val();
        var countryEn = $('countryEn').val();
        var cityAr = $('cityAr').val();
        var cityEn = $('cityEn').val();
        var price = $('price').val();
        var categoryid = $('categoryList').val();
        var supplierid = $('supplierList').val();



        var extension = $('#productimage').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#productimage').val('');
                return false;
            }
        }
        if (productnameAr != '' && productnameEn != '') {
            $.ajax({
                url: "product_save.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode == 200) {
                        $('#addproductModal').modal('hide');
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

        $('#deleteproductModal').modal('show');


    });





    $(document).on("click", "#delete", function() {
        $.ajax({
            url: "product_save.php",
            type: "POST",
            cache: false,
            data: {
                type: 3,
                id: $("#id_d").val()
            },
            success: function(dataResult) {
                $('#deleteproductModal').modal('hide');
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
                    url: "product_save.php",
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
        $('#editproductModal').modal('show');

        var id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var nameEn = $(this).attr("data-nameEn");
        var description = $(this).attr("data-description");
        var descriptionEn = $(this).attr("data-descriptionEn");
        var addressAr = $(this).attr("data-addressAr");
        var addressEn = $(this).attr("data-addressEn");
        var countryAr = $(this).attr("data-countryAr");
        var countryEn = $(this).attr("data-countryEn");
        var cityAr = $(this).attr("data-cityAr");
        var cityEn = $(this).attr("data-cityEn");
        var price = $(this).attr("data-price");
        var categoryid = $(this).attr("data-category_id")
        var supplierid = $(this).attr("data-supplier_id")

        var image = $(this).attr("data-image");
        $('#id_u').val(id);
        $('#productnameAr_u').val(name);
        $('#productnameEn_u').val(nameEn);
        $('#descriptionAr_u').val(description);
        $('#descriptionEn_u').val(descriptionEn);
        $('#addressAr_u').val(addressAr);
        $('#addressEn_u').val(addressEn);
        $('#countryAr_u').val(countryAr);
        $('#countryEn_u').val(countryEn);
        $('#cityAr_u').val(cityAr);
        $('#cityEn_u').val(cityEn);
        $('#price_u').val(price);
        $('#categoryList_u').val(categoryid);
        $('#supplierList_u').val(supplierid);

        $("#Image_u").attr("src", "images/products/" + image);
        $('#hidden_user_image_u').val(image);
    });


    $(document).on('submit', '#update_form', function(event) {
        event.preventDefault();
        var productnameAr = $('#productnameAr_u').val();
        var productnameEn = $('#productnameEn_u').val();
        var addressAr = $('addressAr_u').val();
        var addressEn = $('addressEn_u').val();
        var countryAr = $('countryAr_u').val();
        var countryEn = $('countryEn_u').val();
        var cityAr = $('cityAr_u').val();
        var cityEn = $('cityEn_u').val();
        var price = $('price_u').val();
        var category_id = $('phone_u').val();
        var mobile = $('mobile_u').val();

        var extension = $('#productimage_u').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#productimage_u').val('');
                return false;
            }
        }
        if (productnameAr != '' && productnameEn != '') {
            $.ajax({
                url: "product_save.php",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode == 200) {
                        $('#editproductModal').modal('hide');
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