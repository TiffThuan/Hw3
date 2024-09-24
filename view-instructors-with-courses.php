<h1>Instructors with Courses </h1>
<div class="card-group">
<?php

while ($instructor = $instructors -> fetch_assoc() {
?>
         <div class="card">
   
    <div class="card-body">
      <h5 class="card-title"><?php echo $instructor['firstname'];?> e</h5>
      <p class="card-text">
         <ul class="list-group">
      
        <?php
       $courses=selectCoursesByInstructor($instructor['customer_id']);
        while($course= $courses -> fetch_assoc()){
          ?>
          <li class="list-group-item"><?php echo $course['order_id'];?> -<?php echo $course['status'];?> -<?php echo $course['quantity'];?> - <?php echo $course['price'];?>   </li>

          <?php
        }
        ?>
         </ul> 
      </p>
      <p class="card-text"><small class="text-body-secondary">Office: <?php echo $instructor['address'];?></small></p>
    </div>
  </div>

<?php
}
?>  
</div>
