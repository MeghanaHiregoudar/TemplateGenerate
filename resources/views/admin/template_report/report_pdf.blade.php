<html>
    <head>
        <style>
            /** Define the margins of your page **/
            
            #print_page {
        
        		margin-left: 0.75in;
        		
        	}
        </style>
    </head>
    <body>
      
        <!-- Wrap the content of your PDF inside a main tag -->
        <div id="print_page">
           <?php 
            //This is for generating pdf
                $body = $report->letter_body;
                $newBody = $body;
            ?>
            {!! $newBody !!}
        </div>
    </body>
</html>
