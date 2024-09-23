<h1>Courses  </h1>
<div class="table-responsive">
  <table class="table">
   <thead>
     <tr>
       <th> ID </th>
     <th>Total Amount</th>
     <th>Status</th>
       
     </tr>
     
   </thead> 
    <tbody>
      <?php
while ($instructor = $instructors -> fetch_assoc() {
    ?>
       <tr>
         <td><?php echo $course['order_id'];?> </td>
         <td><?php echo $course['total_amount'];?>  </td>
         <td><?php echo $course['status'];?>  </td>
    
       </tr>
       <?php
}
      ?>  
    </tbody>
  </table>
</div>
