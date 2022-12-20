<div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body">
        <div class="table-responsive">
                <table class="table product-overview" id="zero_config">
                    <thead>
                        <tr>
                            <th>ID#</th>
                            <th>PID</th>
                            <th>PRICE</th>
                            <th>COLOR</th>
                            <th>SIZE</th>
                            <th>CATEGORY</th>
                            <th>BRAND</th>
                            <th>DATE OF PURCHASE</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                         $supplies = $pos->getSalesReport();
                        if($supplies)
                        {
                            $id = 1;
                            foreach ($supplies as $key => $supply) {
                                 
                        ?>
                        <tr>
                            <td class="sorting_1"><?php echo $id; ?></td>
                            <td class="sorting_1"><?php echo $supply['product_ID']; ?></td>
                            <td class="sorting_1"><?php echo $supply['price']; ?></td>
                            <td class="sorting_1"><?php echo ucfirst($supply['color']); ?></td>
                            <td class="sorting_1"><?php echo $supply['size']; ?></td>
                            <td class="sorting_1"><?php echo $pos->getCategoryById($supply['category'])['name']; ?></td>
                            <td class="sorting_1"><?php echo $pos->getBrandById($supply['brand'])['name']; ?></td>
                             
                            <td><?php echo $formats->formatTimeStamp('m/d/Y h:m A',$supply['DOP']); ?></td> 
                        </tr>
                        <?php $id++; } }else{echo "No Records yet!";} ?>
                    </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
</div>