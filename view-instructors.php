<h1>Instructors  </h1>
<div class="table-responsive">
  <table class="table">
   <thead>
     <tr>
       <th> ID </th>
     <th>Name</th>
     <th>Address</th>
     </tr>
     
   </thead> 
    <tbody>
      <?php
while ($instructor = $instructors -> fetch_assoc() {
    ?>
       <tr>
         <td><?php echo $instructor['customer_id'];?> </td>
         <td><?php echo $instructor['firstname'];?>  </td>
         <td><?php echo $instructor['address'];?>  </td>
       </tr>
       <?php
}
      ?>  
    </tbody>
  </table>
</div>
