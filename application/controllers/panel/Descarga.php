<?php
header('Content-disposition: attachment; filename="<?php base_url()."src/pdf/pdf1.pdf";?>"');
header("Content-type: MIME");
readfile("pdf1.pdf.extension");
