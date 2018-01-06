<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
</head>
<body>

<form Id='Form2' Method='post' Action='https://pep.shaparak.ir/gateway.aspx'>
    invoiceNumber<input type='text' name='invoiceNumber' value={{ $invoiceNumber }} /><br />
    invoiceDate<input type='text' name='invoiceDate' value={{ $invoiceDate }} /><br />
    amount<input type='text' name='amount' value={{ $amount }} /><br />
    terminalCode<input type='text' name='terminalCode' value={{ $terminalCode }} /><br />
    merchantCode<input type='text' name='merchantCode' value={{ $merchantCode }} /><br />
    redirectAddress<input type='text' name='redirectAddress' value={{ $redirectAddress }} /><br />
    timeStamp<input type='text' name='timeStamp' value={{ $timeStamp }} /><br />
    action<input type='text' name='action' value={{ $action }} /><br />
    sign<input type='text' name='sign' value={{ $result }} /><br />
    <input type='submit' name='submit' value='Checkout' />
</form>
</body>
</html>