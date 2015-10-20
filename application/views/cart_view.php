<?php echo form_open('products/update_cart'); ?>

    <table cellpadding="6" cellspacing="1" style="width:100%" border="0">

        <tr>
            <th>No</th>
            <th>Quantity</th>
            <th>Name</th>
            <th>id</th>
            <th style="text-align:right">Item Price</th>
            <th style="text-align:right">Sub-Total</th>
        </tr>

        <?php $i = 1; ?>

        <?php foreach ($this->cart->contents() as $items): ?>

            <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

            <tr>
                <td>
                    <?php echo $i; ?>
                </td>
                <td>
                    <input type="number" name="<?php echo $i.'[qty]' ?>" min="0" max="<?php echo $items['max_qty'] ?>" value="<?php echo $items['qty'] ?>" >
                    
                </td>
                <td>
                    <?php echo $items['name']; ?>
                </td>
                <td>
                    <?php echo $items['id']; ?>
                </td>



                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>

            </tr>

            <?php $i++; ?>

        <?php endforeach; ?>

        <tr>
            <td colspan="4"> </td>
            <td style="text-align:right"><strong>Total</strong></td>
            <td style="text-align:right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
        </tr>

    </table>
    <p id="error_mesage"></p>
    <p><?php echo form_submit('', 'Update your Cart'); ?></p>
    <p><button type="button" onclick="confirm_order()" >Confirm Order</button></p>

<script>
    function confirm_order() {
         $.ajax({
            type: "POST",
            url: "confirm_order",
            dataType: 'json'
        }).done(function(msg){
            if(msg.state==1){
     //go to payment
            }else if(msg.state==3){
                window.location = "../account"
            }else if(msg.state==2){
                document.getElementById("error_mesage").innerHTML="Empty Cart";
            }
            else if(msg.state==0){
                document.getElementById("error_mesage").innerHTML="Product ID "+msg.problem_id+" only can have maximum "+msg.problem_quantity;
            }
                
        }); 
             
    }
</script>
