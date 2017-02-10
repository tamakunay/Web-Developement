<!-- footer -->
<footer class="footer text-center">
    <div class="footer-top">
        <div class="row">
            <div class="col-md-offset-3 col-md-6 text-center">
                <div class="widget">
                    <h4 class="widget-title">Mustang</h4>
                    <address>Stamford<br> address, DL 110013</address>
                    <div class="social-list">
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </div>
                    <p class="copyright clear-float">
                        &copy; Mustang. All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- / footer -->

<!-- jquery & javascript  -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>


<!--custom Javascript and jQuery to handle adding products to cart -->
<script>
    var shopcart = [];
    $(document).ready(function () {
        outputCart();
        $('#output').on('change keyup', '.dynqua', function () {
            var iteminfo = $(this.dataset)[0];
            var itemincart = false;
            console.log(shopcart);
            var qty = $(this).val();
            if (qty < 0) {
                qty = 0;
                $(this).val(0);
            }
            $.each(shopcart, function (index, value) {
                if (value.id == iteminfo.id) {
                    shopcart[index].qty = qty;
                    itemincart = true;
                }
            })
            sessionStorage["sca"] = JSON.stringify(shopcart);
            outputCart();
        })

        function outputCart() {
            if (sessionStorage["sca"] != null) {
                shopcart = JSON.parse(sessionStorage["sca"].toString());
            }
            console.log(sessionStorage["sca"]);
            console.log(shopcart);
            var holderHTML = '';
            var total = 0;
            var itemCnt = 0;
            $.each(shopcart, function (index, value) {
                var stotal = value.qty * value.price;
                var a = (index + 1);
                total += stotal;
                itemCnt += parseInt(value.qty);
                holderHTML += '<tr><td><input size="5"  type="number" class="dynqua" name="quantity_' + a + '" value="' + value.qty + '" data-id="' + value.id + '"></td><td><input type="hidden" name="item_name_' + a + '" value="' + value.name + ' ' + value.s + '">' + value.name + '(' + value.s + ')</td><td><input type="hidden" name="amount_' + a + '" value="' + formatMoney(value.price) + '"> $' + formatMoney(value.price) + ' </td><td class="text-xs-right"> ' + formatMoney(stotal) + '</td></tr>';
            })
            holderHTML += '<tr><td colspan="3" class="text-xs-right">Total</td><td class="text-xs-right">$' + formatMoney(total) + '</td></tr>';
            $('#output').html(holderHTML);
        }

        function formatMoney(n) {
            return (n / 100).toFixed(2);
        }
    })
</script>

</body>
</html>