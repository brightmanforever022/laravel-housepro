<style type="text/css">
    div {
        border: 1px solid black;
        padding: 5px;
        margin: 5px;
        width: 600px;
        height: 600px;
        float: left;
        color: white;
    }
     .grayscale {
         background: url(http://development.hestawork.com/apartolino1/public/cities/Bern_color.jpg);
         -moz-filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
         -o-filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
         -webkit-filter: grayscale(100%);
         filter: gray;
         filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
     }

    .nongrayscale {
        background: url(http://development.hestawork.com/apartolino1/public/cities/Bern_color.jpg);
    }
</style>
<script type="text/javascript">
$(document).ready(function () {
    $("#image").mouseover(function () {
        $(".nongrayscale").removeClass().fadeTo(400,0.8).addClass("grayscale").fadeTo(400, 1);
    });
    $("#image").mouseout(function () {
        $(".grayscale").removeClass().fadeTo(400, 0.8).addClass("nongrayscale").fadeTo(400, 1);
    });
});
</script>
<div class="container">
    <div class="row">
        <div id="image" class="nongrayscale"></div>
        <svg>
  <defs>
    <filter xmlns="http://www.w3.org/2000/svg" id="desaturate">
      <feColorMatrix type="saturate" values="0" />
    </filter>
  </defs>
  <image xlink:href="http://www.polyrootstattoo.com/images/Artists/Buda/40.jpg" width="600" height="600" filter="url(#desaturate)" />
</svg>
    </div>
</div>

