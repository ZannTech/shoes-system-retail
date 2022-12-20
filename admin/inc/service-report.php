<div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body">
        <div class="table-responsive">
                <table class="table product-overview" id="zero_config">
                    <thead>
                        <tr> 
                            <th>PID</th>
                            <th>PRICE</th>
                            <th>COLOR</th>
                            <th>SIZE</th>
                            <th>CATEGORY</th>
                            <th>BRAND</th>
                            <th>Customer Name</th>
                            <th>Customer Address</th>
                            <th>Customer Phone</th>
                            <th>DATE OF PURCHASE</th>
                            <th>Service Date</th>
                            <th>Return Date</th>
                            <th>Charges</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                         $supplies = $pos->getServicesReport();
                        if($supplies)
                        { 
                            foreach ($supplies as $key => $supply) {
                                 
                        ?>
                        <tr> 
                            <td class="sorting_1"><?php echo $supply['product_ID']; ?></td>
                            <td class="sorting_1"><?php echo $supply['price']; ?></td>
                            <td class="sorting_1"><?php echo ucfirst($supply['color']); ?></td>
                            <td class="sorting_1"><?php echo $supply['size']; ?></td>
                            <td class="sorting_1"><?php echo $pos->getCategoryById($supply['category'])['name']; ?></td>
                            <td class="sorting_1"><?php echo $pos->getBrandById($supply['brand'])['name']; ?></td>
                            <td><?php echo $supply['customer_name']; ?></td>
                            <td><?php echo $supply['customer_address']; ?></td>
                            <td><?php echo $supply['customer_phone']; ?></td>
                            <td><?php echo $formats->formatTimeStamp('m/d/Y h:m A',$supply['dateofpurchase']); ?></td> 
                            <td><?php echo $formats->formatTimeStamp('m/d/Y h:m A',$supply['service_date']); ?></td> 
                            <td><?php echo $formats->formatTimeStamp('m/d/Y h:m A',$supply['return_date']); ?></td> 
                            <td><?php echo $supply['service_charges']; ?></td>

                        </tr>
                        <?php   } }else{echo "No Records yet!";} ?>
                    </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
</div>