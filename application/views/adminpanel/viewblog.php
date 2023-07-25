<?php $this->load->view('adminpanel/header'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">view blog</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi">
                    <use xlink:href="#calendar3" />
                </svg>
                This week
            </button>
        </div>
    </div>
<?php
//  echo "<pre>";
// print_r($result); die;


?>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Sr No</th>
              <th scope="col">Title</th>
              <th scope="col">Desc</th>
              <th scope="col">image</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead> 
          <tbody>

          <?php 
          if($result){
                $counter = 1;
            foreach ($result as $key =>$value){
                echo "<tr>
            <td>".$counter."</td>
            <td>".$value['blog_titile']."</td>
            <td>".$value['blog_desc']."</td>
            <td><img src='".base_url().$value['blof_img']."' class ='img-fluid' width = '100' ></td>
            // <td><a class=\"btn btn-info\" href='".base_url().'admin/blog/editblog/'.$value['blogid']."'>Edit</a></td>
            // <td><a class=\"btn delete btn-danger\" href='#.'data-id='".$value['blogid']."'> Delete</a></td>
          </tr>";
         $counter++;
            }
            
          
          }
          else{
            echo "<tr> <td colspan = '6' > No Records found </td></tr>";
          }
        
            //  foreach();
          
          ?>
           
          </tbody>
        </table>
      </div>
      

</main>
<?php $this->load->view('adminpanel/footer'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
  $(".delete").click(function(){
    var delete_id = $(this).attr('data-id');
    var bool = confirm('are you sure you want to delete the blog ');
    console.log(bool);
    if(bool){
      // alert("Move to delete funvtionali using ajax ");
      $.ajax({
        url:'<?= base_url().'admin/blog/deleteblog'?>',
        type:'post',
        data:{'delete_id':delete_id},
        success : function(response){
        console.log(response);
        if(response == "deleted"){
          location.reload();
        }else if((response == "NOT deleted")){
            alert("Somthing want wrong");
        }
        }
      });
    }else{
      alert(" your blog is safe ");
    }
  });

<?php 
 if(isset($_SESSION['updated'])){
  if($_SESSION['updated']== "yes"){
   echo 'alert("data has been updated!");';
  }else if($_SESSION['updated']== "no"){
    echo 'alert("some error data has been not updated!");';
  }
 }
?>
</script>