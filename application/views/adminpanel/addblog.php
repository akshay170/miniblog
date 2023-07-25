<?php $this->load->view('adminpanel/header'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add blog</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi">
                    <use xlink:href="#calendar3" />
                </svg>
                This week
            </button>
        </div>
    </div>

   <form enctype="multipart/form-data" action="<?= base_url() . 'admin/blog/addblog_post' ?>" method="POST">

        <div class="form-group">
            <input type="text" class="form-control" name="blog_title" placeholder="Title">
        </div>
        <br>
        <div class="form-group">
            <textarea class="form-control" name="desc" placeholder="Blog Desc"></textarea>
        </div>
        <br>
        <div class="form-group">
            <input type="file" class="form-control" name="file" placeholder="Title">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">addblog</button>

    </form>

</main>
<?php $this->load->view('adminpanel/footer'); ?>

<script type="text/javascript">

   <?php 
   if(isset($_SESSION['inserted'])){
    if($_SESSION['inserted']=='Yes'){
      echo "alert('data inserted Successfully!')";
   }else{

    echo "alert('Not inserted ')";
}
}

   ?>
</script>

 <!-- CKEDITOR CODE -->
 <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
  

  <script> CKEDITOR.replace( 'desc' );</script>
