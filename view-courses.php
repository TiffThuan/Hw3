<h1>Courses  </h1>
<div class="table-responsive">
  <table class="table">
   <thead>
     <tr>
       <th> ID </th>
     <th>Total Amount</th>
     <th>Status</th>
       <th></th>
       
     </tr>
     
   </thead> 
    <tbody>
      <?php
while ($course = $courses -> fetch_assoc()) {
    ?>
       <tr>
         <td><?php echo $course['order_id'];?> </td>
         <td><?php echo $course['total_amount'];?>  </td>
         <td><?php echo $course['status'];?>  </td>
         <td>
           <form method ="post" action ="sections-by-course.php">
            <input type ="hidden" name ="cid" value = "<?php echo $course['order_id'];?> ">
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">Section</button>
            </div>
          </form>
        
         </td>
       </tr>
       <?php
}
      ?>  
    </tbody>
  </table>
</div>
