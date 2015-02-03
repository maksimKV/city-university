<!DOCTYPE html>
<html>
<head>
  <link href="css/screen.css" media="screen, projection" rel="stylesheet">
  <!-- Here I have inserted my custom stylesheet -->
  <link href="css/custom.css" media="screen" rel="stylesheet">
  <!-- Here I have inserted the fancybox stylesheet -->
  <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="js/jquery.jcarousel.min.js"></script>
  <script src="js/ui/jquery-ui-1.10.4.min.js"></script>
  <script src="js/script.js"></script>
  <!-- Adding the fancybox javascript -->
  <script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.5"></script>
  <!-- Adding my custom javascript -->
  <script src="js/custom.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width:960px;">
  <meta name="copyright" content="Copyright © 2014">
  <link rel="icon" href="favicon.ico">
  <link rel="shortcut icon" href="favicon.ico">
  <title>Schools and Centres | City University London</title>
</head>
<body id="schoolspage">
  <article>
    <header>
      <img src="i/cityuniversitylondonlogo.png" width="320" height="100" alt="City University London" title="City University London Logo">
      <h1>Schools and Centres</h1>
    </header>
  
    <section id="schools">
      <nav>
        <ul>
          <li><a href="#sass">School of Arts and Social Sciences</a></li>
          <li><a href="#sems">School of Engineering and Mathematical Sciences</a></li>
          <li><a href="#shs">School of Health Sciences</a></li>
          <li><a href="#soi">School of Informatics</a></li>
        </ul>
      </nav>
        
        <?php
			$menu_names = array("sass", "sems", "shs", "soi"); // Setting an array with the menu names
			
			// Looping through the menu names
			for($n=0;$n<count($menu_names);$n++) {
				
				// Setting the title of the current menu
				switch(true) {
					case ($menu_names[$n] == "sems") :
						$menu_title = "School of Engineering and Mathematical Sciences";
						break;
					case ($menu_names[$n] == "shs") :
						$menu_title = "School of Health Sciences";
						break;
					case ($menu_names[$n] == "soi") :
						$menu_title = "School of Informatics";
						break;
					default :
						$menu_title = "School of Arts and Social Sciences";
				}
		
				$image_array =  array(); // Defining an image array
				$image_thumbnail_array = array(); // Defining an array for the thumbnails
	
				// Getting the image directory
				$image_directory = dirname(__FILE__) . '/i/' . $menu_names[$n] . '/';
	
				// Applying the PHP DirectoryIterator class
				$directory_iterator = new DirectoryIterator($image_directory);
	
				// Looping through each file in the directory
				foreach($directory_iterator as $image_file) {
					
					// Making sure it does not save the '.' and '..' items
					if (!$image_file->isDot()) {
						
						$current_item = $image_file->getFilename(); // Getting the file names
						
						/*
						 * Logic & Assumptions: 
						 * The most popular image extensions are 3 letters long
						 * I am removing the last four elements of the string which in this case are ".jpg"
						 * which gets me the final two letters of the file name
						 * If it is a thumbnail image the last two letters will be "tn"
						 * I will use this knoledge to seperate the files in two arrays
						 * One for the original images and one for the thumbnails
						*/
						
						$image_type = substr($current_item, -6, 2); // I am substracting the last two letters of the file name
						
						// Making sure the current image is a thumbnail
						if($image_type == "tn") {
							$image_thumbnail_array[] = $current_item; // If it is adds it to the thumbnails array
						} else {
							$image_array[] = $current_item; // If it isn't adds it to the image array
						}
					}
				}
				
					// Printing out the correct section
					echo '<section class="school" id="' . $menu_names[$n] . '">
							<ul class="gallery">';
					
					/*
					 * Logic & Assumptions:
					 * I am assuming that every image is going to have a thumbnail
					 * and that they are always going to be numbered from 01 
					*/
				
						// Looping through the count of the image array and using the number to fetch the current image and thumbnail		
						for($i=0; $i<count($image_array);$i++) {
							$image_number = $i + 1; // Getting the number of the image
							echo '<li>
									<figure>
										<a class="fancybox" href="i/' . $menu_names[$n] . '/' . $image_array[$i] . '">
										<img class="thumbnail" src="i/' . $menu_names[$n] . '/' . $image_thumbnail_array[$i] . '" alt="' . $menu_title . ' ' . $image_number . '" title="' . $menu_title . ' '. $image_number . '" width="600" height="399"></a>
										<figcaption>' . $menu_title . ' ' . $image_number . '</figcaption>
									</figure>	
								  </li>';
						}
						
						echo '</ul>
								<a class="jcarousel-control-prev" href="#">‹</a>
								<a class="jcarousel-control-next" href="#">›</a>
								<div class="jcarousel-pagination"></div>
							  </section>';
				}
		?>
    </section>

    <section id="sidebar">
      <h1>About City</h1>
      <p>City University London is a leading international University and the only university in London to be both committed to academic excellence and focused on business and the professions.</p>
      <p>City University London is a special place. With skill and dedication, we have been using education, research and enterprise to transform the lives of our students, our community and the world for over a hundred years.</p>
      <h2>Academic excellence for business and the professions</h2>
      <p>We are a leading international university and the only university in London to be both committed to academic excellence and focused on business and the professions.</p>
    </section>

    <footer>
      <p><a href="http://www.city.ac.uk/">City University London</a>, Northampton Square, London EC1V 0HB, United Kingdom | <a href="tel:+442070405060">+44 (0)20 7040 5060</a></p>
    </footer>
  </article>
</body>
</html>
