<?php
    $this->title = 'Swagger';
?>
  <link href='vendors/swagger-ui/dist/css/typography.css' media='screen' rel='stylesheet' type='text/css' property='stylesheet' />
  <link href='/server/web/vendors/swagger-ui/dist/css/reset.css' media='screen' rel='stylesheet' type='text/css' property='stylesheet' />
  <link href='/server/web/vendors/swagger-ui/dist/css/screen.css' media='screen' rel='stylesheet' type='text/css' property='stylesheet' />
  <link href='/server/web/vendors/swagger-ui/dist/css/reset.css' media='print' rel='stylesheet' type='text/css' property='stylesheet' />
  <link href='/server/web/vendors/swagger-ui/dist/css/print.css' media='print' rel='stylesheet' type='text/css' property='stylesheet' />

  <!--script src='/server/web/vendors/swagger-ui/dist/lib/jquery-1.8.0.min.js' type='text/javascript'></script-->
  <script src='https://code.jquery.com/jquery-migrate-1.3.0.min.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/lib/jquery.slideto.min.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/lib/jquery.wiggle.min.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/lib/jquery.ba-bbq.min.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/lib/handlebars-2.0.0.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/lib/underscore-min.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/lib/backbone-min.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/swagger-ui.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/lib/highlight.7.3.pack.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/lib/jsoneditor.min.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/lib/marked.js' type='text/javascript'></script>
  <script src='/server/web/vendors/swagger-ui/dist/lib/swagger-oauth.js' type='text/javascript'></script>
  
<script>

    var swaggerUi = new SwaggerUi({
      url:"https://toptal-comp2912.c9users.io/server/web/v1/swagger",
      dom_id:"swagger-ui-container"
    });
    
    swaggerUi.load();

</script>


<div class="swagger-section">
    <div id='header' style="display:none;">
      <div class="swagger-ui-wrap">
        <a id="logo" href="http://swagger.io">swagger</a>
        <form id='api_selector'>
          <div class='input'><input placeholder="http://example.com/api" id="input_baseUrl" name="baseUrl" type="text"/></div>
          <div class='input'><input placeholder="api_key" id="input_apiKey" name="apiKey" type="text"/></div>
          <div class='input'><a id="explore" href="#" data-sw-translate>Explore</a></div>
        </form>
      </div>
    </div>

    <div id="message-bar" class="swagger-ui-wrap" data-sw-translate>&nbsp;</div>
    <div id="swagger-ui-container" class="swagger-ui-wrap"></div>

</div>
