<button type="button" onclick="WXPayment()">
    <?php echo $price; ?> $
</button>
<script>
    var WXPayment = function () {
        if (typeof WeixinJSBridge === 'undefined') {
            alert('invalid！');
            return false;
        }
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest', <?php echo $payment->getConfig(); ?>, function (res) {
                switch (res.err_msg) {
                    case 'get_brand_wcpay_request:cancel':
                        alert('cancel！');
                        break;
                    case 'get_brand_wcpay_request:fail':
                        alert('fail！（' + res.err_desc + '）');
                        break;
                    case 'get_brand_wcpay_request:ok':
                        alert('success！');
                        break;
                    default:
                        alert(JSON.stringify(res));
                        break;
                }
            }
        );
    }
</script>