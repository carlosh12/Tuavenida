
<form action="callback.php" method="post">
    
date: <input type="text" name="date" value="<?php echo date("Y-m-d H:i:s"); ?>"/> <br/>
user_id: <input type="text" name="user_id" value="1" /><br/>
transaction_id: <input type="text" name="transaction_id" value="x" /><br/>
product_id: <input type="text" name="product_id" value="DEVELOPER_PRODUCT"/><br/>
currency: <input type="text" name="currency" value="BRL" /><br/>
product_description: <input type="text" name="product_description" value="TEST"/><br/>
payment_method: <input type="text" name="payment_method" value="100" /><br/>
dev_reference: <input type="text" name="dev_reference" /><br/>

<input type="submit" />
</form>

