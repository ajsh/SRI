<?php
namespace slabsTheme;
$path = getenv("HTTP_SERVER_PATH");
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';

use InvalidArgumentException;
use RuntimeException;


class Theme 
{
	//==== CONSTANTS ====\\
	const VERSION = '2.0.0-beta.3';



	//==== VARIABLES ====\\

	// Configuration
	// @var array
	protected $options = [];

	//=============================================================================================================================================

	//==== SETUP FUNCTIONS ====\\
	public function __construct($pageTitleOrOptions = null, $options = []){
		// Create new object
		// @param array|string $pageTitleOrOptions Either the page_title or an options array
		// @param array $options (optional) Array of options if first argument is page_title

		$this->configure();
		$this->init();
		if (!is_array($pageTitleOrOptions))
		{
			$options['page_title'] = $pageTitleOrOptions;
		}
		else {
			$options = $pageTitleOrOptions;
		}
		if ($options) {
			$this->setOptions($options);
		}
	}

	protected function configure(){
		global $path;
		// Default configuration

		$this->setOptions([

			// show
			'show_header'				=> true,
			'show_navbar_slabs'			=> false,
			'show_navbar_site'			=> true,
			'show_search_box'			=> false,
			'show_site_title'			=> true,
			'show_site_links'			=> true,
			'show_navbar_menu'			=> true,
			'show_breadcrumbs'			=> false,
			'show_page_title'			=> true,
			'show_footer'				=> true,

			// search
			'search_action'				=> '//google.iastate.edu/search',
			'search_client'				=> 'default_frontend',
			'search_output'				=> 'xml_no_dtd',
			'search_placeholder'		=> 'Search',
			'search_site'				=> $_SERVER['HTTP_HOST'],
			'search_submit'				=> 'Search',
			'search_style'				=> 'default_frontend',

			// navs
			'site_links'				=> null,
			'navbar_menu'				=> null,
			'navbar_caps'				=> true,
			'navbar_menu_hover'			=> true,
			'navbar_menu_affix'			=> true,

			'request_uri'				=> null,
			'right_sidebar'				=> null,
			'right_nav'					=> null,
			'right_nav_scrollspy'		=> false,
			'right_nav_affix'			=> false,
			'right_nav_collapse'		=> false,

			// apps
			'authorization_callback'	=> null,
			'route_callback'			=> null,
			'translator_callback'		=> null,

			// titles
			'head_title' => function(Theme $theme) {
				$titles = [];
				foreach (['page', 'site', 'org'] as $type) {
					if (($part = $theme->getOption($type .'_title')) != null) {
						if (count($titles) && $titles[count($titles) - 1] == $part) {
							continue;
						}
						$titles[] = $part;
					}
				}
				return $titles;
			},
			'title_separator'			=> ' • ',
			'org_title'					=> 'Iowa State University',
			'org_url'					=> 'http://www.iastate.edu/',
			'site_title'				=> null,
			'site_url'					=> '',
			'page_title'				=> null,

			// site
			'full_width'				=> false,

			'post_nav'					=> '',
			'hero_image'				=> null,

			'base_path' => '',
			'asset_path' => '',
			'module_asset_path' => '',
			'theme_asset_path' => '',

			// <head>
			'head_meta' => [
				'charset' => 'utf-8',
				'x_ua_compatible' => [
					'content' => 'IE=edge,chrome=1',
					'key_value' => 'X-UA-Compatible',
					'key_type' => 'http-equiv',
				],
				'viewport' => 'width=device-width,initial-scale=1',
				'format-detection' => 'telephone=no',
			],
			// <head> <link>s
			'head_link' => [
				'legacy' => [
					'href' => '{{theme_asset_path}}/css/slabs.legacy.min.css',
					'order' => -2,
				],
				'nimbus_sans' => [
					'href' => '//cdn.theme.iastate.edu/nimbus-sans/css/nimbus-sans.css',
				],
				'font_awesome' => [
					'href' => '//cdn.theme.iastate.edu/font-awesome/css/font-awesome.css',
				],
				'slabs' => [
					'href' => '{{theme_asset_path}}/css/slabs.min.css?v='. self::VERSION,
				],
				'favicon' => [
					'href' => '//cdn.theme.iastate.edu/favicon/favicon.ico',
					'rel' => 'icon',
					'type' => 'image/x-icon',
				],
				'faviconpng' => [
					'href' => '//cdn.theme.iastate.edu/favicon/favicon.png',
					'rel' => 'icon',
					'type' => '',
				],
				'faviconappletouch' => [
					'href' => '//cdn.theme.iastate.edu/favicon/apple-touch-icon.png',
					'rel' => 'icon',
				],

			],
			// <head> <style>s
			'head_style' => [],
			// <head> <script>s
			'head_script' => [
				'file' => [
				    'javascript0' =>$path.'/pages/ss/jquery.min.js',
                    'javascript1'=>$path.'/pages/ss/script.js',
                    //'javascript_table'=>'/jtable/jquery.jtable.min.js',
                    'javascript_typeahed'=>$path.'/pages/ss/typeahead.min.js',
                    'jquery_url0'=>'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
                    'bootstrap_url'=>'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'


                ],
				// 'script' => [
				//     'content'=>'  $(document).ready(function(){
    			// $(\'input.typeahead\').typeahead({
    			//     name: \'typeahead\',
    			//     remote:\'pages/parts/data/search.php?key=%QUERY\',
    			//     limit : 10
    			//  });'
    			//             ],
			],
			// </body> <script>

			'inline_script' => [
				'file' => [
					'jquery' => '//code.jquery.com/jquery-1.11.3.min.js',
					'bootstrapjs' => '{{theme_asset_path}}/js/vendor/bootstrap.min.js',
					'sub_menu' => '{{theme_asset_path}}/js/vendor/bootstrap-submenu.min.js',
					'slabs' => '{{theme_asset_path}}/js/slabs.js',
				],
				'script' => [],
			],

			'render_tags' => [
				'email' => function($str, Theme $theme)
				{
					list(, $email, $label) = array_pad(explode('|', $str), 3, null);
					return $theme->email($email, $label);
				},
			],

			// footer
			'footer_associates' => [],
			'footer_contact' => [
				'address' => [
					'Structural Labs', 	// line 1
					'813 Bissell Road',			// line 2
					'Ames, IA 50014',		// ...
				],
				'email' => [
					'contact@iastate.edu',	// line 1, add more, just like address
				],
				'phone' => [
					'515-441-4982',			// line 1, add more, just like address
				],
				'faxe' => [
					'515-508-9120',			// line 1, add more, just like address
				],
			],
			'show_social_labels' => true,
			'footer_social' => [
				[
					'label' => 'Facebook',
					'url' => 'http://facebook.com/IowaStateU/',
				],
				[
					'label' => 'Twitter',
					'url' => 'http://twitter.com/iowastateu?lang=en',
				],
				[
					'label' => 'Instagram',
					'url' => 'http://instagram.com/iowastateu/',
				],
				[
					'label' => 'YouTube',
					'url' => 'http://youtube.com/user/iowastateu',
				],
		],
		'footer_legal' => [
			'statement' => 'Copyright &copy; 1995-<script>document.write(new Date().getFullYear())</script><br>
								Iowa State University<br>
								of Science and Technology<br>
								All rights reserved.',
				'links' => [
					[
						'label' => 'Non-discrimination Policy',
						'url' => 'http://www.policy.iastate.edu/policy/discrimination'
					],
					[
						'label' => 'Privacy Policy',
						'url' => 'http://www.policy.iastate.edu/electronicprivacy'
					],
					[
						'label' => 'Digital Access &amp; Accessibility',
						'url' => 'http://digitalaccess.iastate.edu'
					],
				],
			],
		]);
	}

	protected function init(){
		// This code is called at the beginning of __construct and can be overwritten by options provided to the constructor
		return $this;
	}

	//==== OPTION FUNCTIONS ====\\
	protected function inflectOptionName($name){
		// Convert an option name from camelCase to under_score
		// @param string $name
		// @return string
		// -=LEGACY=-

		if (strtolower($name) != $name)
		{
			$name = preg_replace_callback('/[A-Z]/', function($m)
			{
				return '_'. strtolower($m[0]);
			}, $name);
		}
		return $name;
	}

	public function hasOption($name){
		// Check to see if has option set
		// @param string $name
		// @return bool

		return array_key_exists($this->inflectOptionName($name), $this->options);
	}

	public function getOption($name, $default = null){
		// Get an option. Optionally return a preset default value in case option is not set or is null.
		// @param string $name
		// @param mixed $default
		// @return mixed

		$name = $this->inflectOptionName($name);
		if (isset($this->options[$name]))
		{
			return $this->options[$name];
		}
		return $default;
	}

	public function setOption($name, $value, $reset = false){
		// Set an option. Will merge value with existing by default if value is an array.
		// @param string $name
		// @param mixed $value
		// @param bool $reset replace existing value if true instead of merging

		$name = $this->inflectOptionName($name);
		if (!$reset && isset($this->options[$name]) && is_array($this->options[$name]) && is_array($value))
		{
			$value = $this->merge($this->options[$name], $value);
		}
		$this->options[$name] = $value;
		return $this;
	}

	public function getOptions(){
		// Get all options (for debugging).
		// @return array
		return $this->options;
	}

	public function setOptions(array $options){
		// Set multiple options.
		// @param array $options

		if (!empty($options))
		{
			foreach ($options as $name => $value)
			{
				if($name == 'carousel' || (substr($name,0,7) == 'footer_' && (is_array($value) && !empty($value))))
				{
					$this->setOption($name, $value, true);
					continue;
				}
				$this->setOption($name, $value);
			}
		}
		return $this;
	}
	//=============================================================================================================================================
	
	//==== MISC FUNCTIONS ====\\
	protected function merge(array $a, array $b){
		// Merge two arrays recursively.
		// If an integer key exists in both arrays, the value from the second array will be appended the the first array. If both values are arrays, they are merged together, else the value of the second array overwrites the one of the first array.
		// @param array $a
		// @param array $b
		// @return array

		foreach ($b as $key => $value)
		{
			if (array_key_exists($key, $a))
			{
				if (is_int($key))
				{
					$a[] = $value;
				}
				elseif (is_array($value) && is_array($a[$key]))
				{
					$a[$key] = $this->merge($a[$key], $value);
				}
				else
				{
					$a[$key] = $value;
				}
			}
			else
			{
				$a[$key] = $value;
			}
		}
		return $a;
	}

	public function addStyle($spec, $mode = 'link'){
		// Add a style asset to be rendered within the <head> element. Can be a url or inline style content.
		// @param array|string $spec Either a url or inline style (do NOT include <style> tags). Can also be an array:
		//     - if $mode is 'link'
		//         - an array of html element attributes (href, media, rel, etc.) and order
		//     - if $mode is 'style'
		//         - content: the inline style content (do NOT include <style> tags)
		//         - attributes: an array of html element attributes
		// @param string $mode Either 'link' for urls or 'style' for inline styles
		// @return
		// @throws InvalidArgumentException if incorrect $mode provided

		if (is_string($spec) && strlen(trim($spec)) == 0)
		{
			return $this;
		}
		if ($mode != 'link' && $mode != 'style')
		{
			throw new InvalidArgumentException(sprintf(
				"Expected \$mode to be 'link' or 'style', got '%s' instead"
				, $mode
			));
		}
		$this->setOption('head_' . $mode, [
			md5(serialize($spec)) => $spec,
		]);
		return $this;
	}

	public function addScript($spec, $mode = 'file', $position = 'inline'){
		// Add a script asset to be rendered within the <head> element or within the <body> element
		// Can be a URL or inline script content
		// @param array|string $spec Either a URL or inline script (do NOT include <script> tags). Can also be an array:
		//     - if $mode is 'file'
		//         - an array of HTML element attributes (src, type, etc.) and order
		//     - if $mode is 'script'
		//         - content: the inline script content (do NOT include <script> tags)
		//         - attributes: an array of html element attributes
		// @param string $mode Either 'file' for urls or 'script' for inline scripts
		// @param string $position Either 'head' to place inside <head> or 'inline' to append to <body>
		// @return
		// @throws InvalidArgumentException if incorrect $mode or $position is provided

		if (is_string($spec) && strlen(trim($spec)) == 0)
		{
			return $this;
		}
		if ($mode != 'file' && $mode != 'script')
		{
			throw new InvalidArgumentException(sprintf(
				"Expected \$mode to be 'file' or 'script', got '%s' instead"
				, $mode
			));
		}
		if ($position != 'head' && $position != 'inline')
		{
			throw new InvalidArgumentException(sprintf(
				"Expected \$position to be 'head' or 'inline', got '%s' instead"
				, $position
			));
		}
		$this->setOption($position . '_script', [
			$mode => [
				md5(serialize($spec)) => $spec,
			],
		]);
		return $this;
	}

	protected function calculateActiveRating($page){
		// Calculate active
		// Returns an array containing the percentage match for each page.
		// The match for a node is the maximum of the node and all of its descendant node matches.
		// @param array $page
		// @return array
		$active = [
			'value' => 0,
			'pages' => [],
		];
		if (!isset($page['noselect']) || $page['noselect'] !== true)
		{
			$reqUri = $this->getOption('request_uri', $_SERVER['REQUEST_URI']);
			if (isset($page['uri']))
			{
				$uri = $this->render($page['uri']);
			}
			elseif (isset($page['route']))
			{
				$uri = $this->url($page['route']);
			}
			else
			{
				$uri = '';
			}
			$value = 0;
			if ($uri == $reqUri)
			{
				$value = 100;
			}
			elseif ($uri != '' && strpos($reqUri, $uri) === 0)
			{
				$value = round(100 * strlen($uri) / strlen($reqUri));
			}
			if (isset($page['pattern']))
			{
				if (preg_match($page['pattern'], $reqUri))
				{
					$value = 100;
				}
			}
			if ($value > 0 && isset($page['nopattern']))
			{
				if (preg_match($page['nopattern'], $reqUri))
				{
					$value = 0;
				}
			}
			if (!empty($page['pages']))
			{
				foreach ($page['pages'] as $i => $child)
				{
					$active['pages'][$i] = $this->calculateActiveRating($child);
				}
				$value = max($value, max(array_map(function ($child)
				{
					return $child['value'];
				}, $active['pages'])));
			}
			$active['value'] = $value;
		}
		return $active;
	}
	
	protected function activateMaxRating(&$pages){
		// Remove active (except for most 'active' pages within the tree)
		// @param array $pages
		if (empty($pages))
		{
			return;
		}
		$max = max(array_map(function ($page)
		{
			return $page['value'];
		}, $pages));
		foreach ($pages as &$page)
		{
			if ($page['value'] < $max)
			{
				$page['value'] = 0;
			}
			$this->activateMaxRating($page['pages']);
		}
	}

	public function sort($items){
		// Returns the keys of the given array sorted by the order property of each array item in ascending order.
		// <code>
		// print $this->sort([
		//     'item1' => [
		//         'label' => 'Item 1',
		//     ],
		//     'item2' => [
		//         'label' => 'Item 2',
		//         'order' => -1,
		//     ],
		// ]);
		// // [
		// //     'item2',
		// //     'item1',
		// // ]
		// </code>
		// @param array $items
		// @return array
		$index = [];
		$c = 0;
		foreach ($items as $i => $item)
		{
			if (is_array($item) && isset($item['order']))
			{
				$index[$i] = $item['order'];
			}
			else
			{
				$index[$i] = $c++;
			}
		}
		asort($index);
		return array_keys($index);
	}

	public function renderBreadcrumbs() {
       // Render breadcrumbs
		// @return string
        if ($this->getOption('show_breadcrumbs') && $_SERVER['REQUEST_URI'] != '/')
        {
            $routes = explode('/',$_SERVER['REQUEST_URI']);
            $routeList = '';
            for($i = 0; $i < count($routes)-1; $i++)
            {
                $route = $routes[$i];
                $link = '/' . implode('/', array_slice($routes, $i));
                if ($route != '')
                {
                    $routeList .= '<li';
                    $routeList .= ($i < count($routes)-2) ? '><a href="'.$link.'">'.ucwords($route).'</a>' : ' class="active">'.$this->getOption('page_title');
                    $routeList.='</li>';
                }
            }
            return '

				<div class="breadcrumb-wrapper">
					<div class="container">
						<ol class="breadcrumb">
							<li><a href="/">Home</a></li>'.
							$routeList
						.'</ol>
					</div>
				</div>';
        }
        return '';
    }

	public function renderContentStart(){
		// Render content start
		// @return string
		$this->renderRightNav();
		$rightSidebar = '';
		if ($this->getOption('right_sidebar') !== null)
		{
			$rightSidebar = '
				<div class="row">
					<div class="col-md-9">';
		}

		return '
			<main role="main" id="main-content">'.
				$this->renderHeroImage().$this->renderContainerStart().$rightSidebar;
	}

	public function renderContentEnd(){
		// Render the closing tags for content
		// @return string
		$rightSidebar = '';
		if($this->getOption('right_sidebar') !== null)
		{
			$rightSidebar = '
				</div>
				<div class="col-md-3">
					'.$this->getOption('right_sidebar').'
				</div>
			</div>';
		}
		return $rightSidebar.
				$this->renderContainerEnd().'
			</main>
			<!-- /main -->';
	}

	public function renderHeroImage(){
		// Render hero background image
		// @return string
		$specs = $this->getOption('hero_image');
		if($specs == null)
		{
			return '';
		}
		return '
		<img src="'.$specs['src'].'" alt="'.$specs['description'].'" id="background-hero-image">';
	}
	
	public function renderLoadingBar(){
		//	Render loading indicator
		//	@return string
		return '

			<!-- loading -->
			<div id="loading" class="progress">
				<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
					Loading...
				</div>
			</div>
			<!-- /loading -->';
	}

	public function email($email, $label = null){
		// Returns a spamproof mailto link for the provided email address with an optional label.
		// @param string $email email address or Net-ID
		// @param string $label label for the mailto link (defaults to the email address)
		// @throws InvalidArgumentException if empty email address given
		// @return string
		if ($email == '')
		{
			throw new InvalidArgumentException('Email cannot be empty');
		}
		if (strpos($email, '@') === false)
		{
			$email .= '@iastate.edu';
		}
		$json = array_map('json_encode', explode('@', $email));
		$text = str_replace(['@', '.'], [' (at) ', ' (dot) '], $email);
		$noScript = $label ? "$label ($text)" : $text;
		$email = "[".$json[0].", ".$json[1]."].join('@')";
		$label = $label ? json_encode($label) : $email;

		return '
			<script>document.write("<a href="mailto:'.$email.'">'.$label.'</a>")</script><noscript>'.$noScript.'</noscript>';
	}

	public function createAttributesString(array $attr = []){
		// Create an html element attributes string from an array of attributes.
		// <code>
		// echo '<meta '. $theme->createAttributesString(['charset' => 'utf-8']) .'/>;
		// // '<meta charset="utf-8"/>'
		// </code>
		// @param array $attr
		// @throws InvalidArgumentException for non-scalar attribute values
		// @return string
		$html = [];
		foreach ($attr as $name => $value)
		{
			if (!is_scalar($value))
			{
				throw new InvalidArgumentException(sprintf(
					"HTML attribute value for '%s' must be a scalar, got '%s' instead"
					, $name
					, gettype($value)
				));
			}

			$html[] = $this->escape($name) . '="' . $this->escape($value) . '"';
		}
		return implode(' ', $html);
	}

	public function escape($html){
		// Escape an html snippet including single quotes and with utf-8 encoding.
		// @param string $html
		// @return string
		return htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
	}

	public function translate($text){
		// Translate a string using the translator_callback option.
		// @param string $text
		// @return string
		$callback = $this->getOption('translator_callback');
		if (is_callable($callback))
		{
			return call_user_func($callback, $text);
		}
		return $text;
	}

	public function url($args){
		// Generate a URL using the route_callback option.
		// @param array|string $args
		// @throws RuntimeException
		// @return mixed
		$callback = $this->getOption('route_callback');
		if (!is_callable($callback))
		{
			throw new RuntimeException("'route_callback' option must be a valid callback");
		}
		return call_user_func($callback, $args);
	}

	public function isAllowed($params, $name = null){
		// Check whether allowed access based on a set of roles using the authorization_callback option.
		// @param array|string $params
		// @param string $name
		// @return boolean
		$callback = $this->getOption('authorization_callback');
		$allowed = true;
		if ($callback !== null)
		{
			$allowed = call_user_func($callback, $params, $name);
		}
		return $allowed;
	}

	private function renderScrollTargetList($targets){
		$targetList = [];
		foreach ($targets as $target)
		{
			$id= $target['id'];
			$label= $target['label'];
			$subTargetList = isset($target['sub_targets']) ? $this->renderScrollTargetList($target['sub_targets']) : '';
			$targetList[] = '
				<li>
					<a href="#'.$id.'">'.$label.'</a>
					'.$subTargetList.'
				</li>';
		}
		$targetList = implode("\n", $targetList);
		$attrs = [
			'class' => 'nav',
		];
		return '
			<ul '.$this->createAttributesString($attrs).'>
				'.$targetList.'
			</ul>';
	}




	//=============================================================================================================================================

	//==== CONSTRUCTION FUNCTIONS ====\\

		//==== RENDERING ====\\		
		public function render($template, $vars = []){
				// Render a string replacing placeholders with variables.
				// Place {{base_path}} or {{site_url}} in the string to replace with the respective configuration option.
				// <code>
				// echo $this->render('{{base_path}}/foo-bar');
				// </code>
				// @param string $template
				// @param array $vars custom variables
				// @throws RuntimeException if a filter does not have a valid callback
				// @return string
				$vars = array_merge([
					'{{asset_path}}' => $this->getOption('asset_path'),
					'{{base_path}}' => $this->getOption('base_path'),
					'{{site_url}}' => $this->getOption('site_url'),
					'{{module_asset_path}}' => $this->getOption('module_asset_path'),
					'{{theme_asset_path}}' => $this->getOption('theme_asset_path'),
					'{{year}}' => date('Y'),
				], $vars);

				foreach ($this->getOption('render_tags', []) as $name => $callback)
				{
					if (!is_callable($callback))
					{
						throw new RuntimeException("'render_tag.$name' option must be a valid callback");
					}
					$vars = array_replace($vars, $this->renderTag($template, '{{>' . $name, $callback));
					$vars = array_replace($vars, $this->renderTag($template, '{{> ' . $name, $callback));
				}

				$rendered = strtr($template, $vars);
				if (strpos($rendered, '{{') !== false && $rendered !== $template)
				{
					return $this->render($rendered, $vars);
				}
				return $rendered;
		}

		protected function renderTag($template, $delimiter, $callback){
				// Render a particular tag and return an array containing the tag => string transformation.
				// @param string $template The template to render
				// @param string $delimiter The tag opening delimiter
				// @param callable $callback The tag callback
				// @return array
				$vars = [];
				if (strpos($template, $delimiter) !== false)
				{
					$offset = 0;
					while (($pos = strpos($template, $delimiter, $offset)) !== false)
					{
						if (!in_array(substr($template, $pos + strlen($delimiter), 1), ['|', '}'], true))
						{
							$offset++;
							continue;
						}
						$length = strpos($template, '}}', $pos) + 2 - $pos;
						$match = substr($template, $pos, $length);
						$vars[$match] = call_user_func($callback, substr($match, strlen($delimiter), -2), $this);
						$offset = $pos + $length;
					}
				}
				return $vars;
		}

	//=============================================================================================================================================


		//==== HTML ====\\
		public function renderHtmlStart(){
			// Render <!DOCTYPE> and <html>
			// @return string
			return '
				<!DOCTYPE html>
					<html lang="en">';
		}
			
		public function renderHtmlEnd(){
			// Render </html>
			// @return string
			return "\n" . '</html>';
		}

	//=============================================================================================================================================

		//==== HEAD ====\\
		public function renderHead(){
			// Render <head>
			// @return string
			$arr = [
				$this->renderHeadMeta(),
				$this->renderHeadTitle(),
				$this->renderHeadLink(),
				$this->renderHeadStyle(),
				$this->renderHeadScript(),
			];
			for($i = 0; $i < count($arr); $i++)
			{
				if($arr[$i] == null)
				{
					array_splice($arr, $i, 1);
				}
			}
			$imploded = implode("\n",$arr);
			return '
				<head>
					'.$imploded.'
				</head>';
		}

		public function renderHeadMeta(){
			$items = $this->getOption('head_meta', []);
			$index = $this->sort($items);
			$html = [];
			foreach ($index as $name)
			{
				$spec = $items[$name];
				if (is_callable($spec))
				{
					$spec = call_user_func($spec, $this);
				}
				if (is_null($spec))
				{
					continue;
				}
				if (is_string($spec))
				{
					if ($name == 'charset')
					{
						$attr = [
							'charset' => $spec,
						];
					}
					else
					{
						$attr = [
							'content' => $spec,
							'name' => $name,
						];
					}
				}
				else
				{
					$attr = [
						'content' => $spec['content'],
						$spec['key_type'] => $spec['key_value'],
					];
				}
				$html[] = "\t<meta " . $this->createAttributesString($attr) . ">";
			}
			return implode("\n", $html);
		}

		public function renderHeadTitle(){
			// Render <head> <title>
			// @return string
			$title = $this->getOption('head_title');
			if (is_callable($title))
			{
				$title = call_user_func($title, $this);
			}
			if (is_array($title))
			{
				$title = implode($this->getOption('title_separator'), $title);
			}
			return "\t<title>" . $this->escape($title) . "</title>";
		}
		
		public function renderHeadLink(){
			// Render <head> <link>s
			// @return string
			$items = $this->getOption('head_link', []);
			$index = $this->sort($items);
			$html = [];
			foreach ($index as $name)
			{
				$spec = $items[$name];
				if (is_callable($spec))
				{
					$spec = call_user_func($spec, $this);
				}
				if (is_null($spec))
				{
					continue;
				}
				if (is_string($spec))
				{
					$spec = [
						'href' => $spec,
						'media' => 'all',
						'rel' => 'stylesheet',
					];
				}
				if (isset($spec['href']))
				{
					$spec['href'] = $this->render($spec['href']);
				}
				if (!isset($spec['rel']))
				{
					$spec['rel'] = 'stylesheet';
				}
				unset($spec['order']);
				$html[] = "\t<link " . $this->createAttributesString($spec) . ">";
			}
			return implode("\n", $html);
		}
		
		public function renderHeadStyle(){
			// Render <head> <style>s
			// @return string
			$items = $this->getOption('head_style', []);
			$index = $this->sort($items);
			$html = [];
			foreach ($index as $name)
			{
				$spec = $items[$name];
				if (is_callable($spec))
				{
					$spec = call_user_func($spec, $this);
				}
				if (is_null($spec))
				{
					continue;
				}
				if (is_string($spec))
				{
					$spec = [
						'content' => $spec,
						'attributes' => [],
					];
				}
				$html[] = "\t<style " . $this->createAttributesString($spec['attributes']) . ">" . $spec['content'] . "</style>";
			}
			return implode("\n", $html);
		}

		public function renderHeadScript(){
			// Render <head> <script>s
			// @return string
			return $this->renderScript($this->getOption('head_script', []));
		}

		public function renderPageTitle(){
			// Render the page_title
			// @return string
			if ($this->getOption('show_page_title') !== true)
			{
				return '';
			}
				/*
						return <<<HTML
				<nav class="navbar navbar-static-top navbar-clear">
					{$this->renderContainerStart()}
					<div class="nav navbar-nav navbar-header">
						<h1>{$this->escape($this->getOption('page_title'))}</h1>
					</div>
					{$this->renderContainerEnd()}
				</nav>
				HTML;
				 */
			return '<h1>' . $this->escape($this->getOption('page_title')) . '</h1>';
		}

	//=============================================================================================================================================

		//==== BODY ====\\
		public function renderBodyStart(){
			// Render <body>
			// @return string
			return '<body>';
		}

		public function renderBodyEnd(){
			// Render </body>
			// @return string
			return "\n" . '</body>';
		}

	//=============================================================================================================================================

			//==== HEADER ====\\
			public function renderHeader(){
				// Render <header>
				// @return string
				if ($this->getOption('show_header') !== true)
				{
					return '';
				}
				return implode("\n", [
					$this->renderHeaderStart(),
					$this->renderNavbarslabs(),
					$this->renderNavbarSite(),
					$this->renderHeaderEnd(),
					$this->renderNavbarMenu(),
				]);
			}

			public function drawHeader(){
				// Render head (pre-content functions)
				// @return
				echo $this->renderHtmlStart();
				echo $this->renderHead();
				echo $this->renderBodyStart();
				// echo $this->renderSkipNavigation();
				echo $this->renderHeader();
				echo $this->renderBreadcrumbs();
				echo $this->renderPostNav();
				echo $this->renderContentStart();
				echo $this->renderPageTitle();
				return $this;
			}

			public function renderHeaderStart(){
				// Render <header> start
				// @return string
				return ' 
					<!-- header -->
					<header>';
			}

			public function renderHeaderEnd(){
				// Render </header> end
				// @return string
				return '

				</header>
				<!-- /header -->';
			}

	//=============================================================================================================================================

			//==== NAVIGATION ====\\
			public function renderNav($pages, $depth = 0, $activePages = []){
				// Render menu
				// @param $pages
				// @param int $depth
				// @param array $activePages
				// @return string
				if (empty($pages))
				{
					return '';
				}
				$index = $this->sort($pages);
				if ($depth == 0)
				{
					$activePages = [];
					foreach ($pages as $i => $page)
					{
						$activePages[$i] = $this->calculateActiveRating($page);
					}
					$this->activateMaxRating($activePages);
				}
				$html = [];
				$tabDepth = str_repeat("\t",$depth*2+1);
				foreach ($index as $i)
				{
					$page = $pages[$i];
					$active = $activePages[$i]['value'] > 0;
					// legacy support for 'showchildren'
					if (isset($page['showchildren']) && !isset($page['show_children']))
					{
						$page['show_children'] = $page['showchildren'];
					}
					$showChildren = isset($page['show_children']) && $page['show_children'];
					// legacy support for 'roles' and 'permissions'
					if (isset($page['roles']) && !isset($page['allowed_roles']))
					{
						$page['allowed_roles'] = $page['roles'];
					}
					if (isset($page['permissions']) && !isset($page['allowed_permissions']))
					{
						$page['allowed_permissions'] = $page['permissions'];
					}
					// perform authorization check to see if page visible
					if (isset($page['allowed_roles']) || isset($page['allowed_permissions']))
					{
						$allowedByRole = isset($page['allowed_roles']) && $this->isAllowed($page['allowed_roles'], 'role');
						$allowedByPermission = isset($page['allowed_permissions']) && $this->isAllowed($page['allowed_permissions'], 'permission');
						if (!$allowedByRole && !$allowedByPermission)
						{
							continue;
						}
					}
					if (isset($page['denied_roles']) || isset($page['denied_permissions']))
					{
						$deniedByRole = isset($page['denied_roles']) && $this->isAllowed($page['denied_roles'], 'role');
						$deniedByPermission = isset($page['denied_permissions']) && $this->isAllowed($page['denied_permissions'], 'permission');
						if ($deniedByRole || $deniedByPermission) {
							continue;
						}
					}
					$subNav = null;
					if (isset($page['pages']) && is_array($page['pages']) && ($showChildren || $active))
					{
						$subNav = $this->renderNav($page['pages'], $depth + 1, $activePages[$i]['pages']);
					}
					$nodeClass = [];
					if (!empty($subNav))
					{
						if($depth == 0)
						{
							$nodeClass[] = 'dropdown' . ($this->getOption('navbar_menu_hover') ? ' dropdown-hover' : '');
						}
						else
							{
							$nodeClass[] = 'dropdown dropdown-submenu' . ($this->getOption('navbar_menu_hover') ? ' dropdown-hover' : '');
						}
					}
					if ($active)
					{
						$leaf = true;
						foreach ($activePages[$i]['pages'] as $childPage)
						{
							if ($childPage['value'] > 0)
							{
								$leaf = false;
								break;
							}
						}
						$nodeClass[] = $leaf ? 'active' : 'active';
					}
					$html[] = $tabDepth.'<li class="' . implode(' ', $nodeClass) . '">';
					$attr = [];
					foreach ($page as $key => $value)
					{
						$skip = [
							'label',
							'escape',
							'translate',
							'uri',
							'route',
							'order',
							'pages',
							'show_children', 'showchildren',
							'pattern',
							'nopattern',
							'noselect',
							'icon',
							'roles', 'allowed_roles', 'denied_roles',
							'permissions', 'allowed_permissions', 'denied_permissions',
						];
						if (!in_array($key, $skip))
						{
							$attr[$key] = $value;
						}
					}
					if (isset($page['attributes']))
					{
						foreach ($page['attributes'] as $key => $value)
						{
							$attr[$key] = $value;
						}
					}
					if (isset($attr['class']))
					{
						$attr['class'] = explode(' ', $attr['class']);
					}
					else
					{
						$attr['class'] = [];
					}
					if (isset($page['uri']) || isset($page['route']))
					{
						if (isset($page['uri']))
						{
							$attr['href'] = $this->render($page['uri']);
						}
						elseif (isset($page['route']))
						{
							$attr['href'] = $this->url($page['route']);
						}
						// check here for "active" if you want that class on <a>s
					}
					$tag = 'a';
					if ($subNav && $depth == 0)
					{
						$attr['class'][] = 'dropdown-toggle';
						$attr['role'] = 'button';
						$attr['data-toggle'] = $this->getOption('navbar_menu_hover') ? '' : 'dropdown';
						$attr['aria-haspopup'] = 'true';
						$attr['aria-expanded'] = 'false';
						$attr['data-submenu'] = '';
					}
					if ($subNav && !$this->getOption('navbar_menu_hover'))
					{
						$attr['href'] = '#';
					}
					$attr['tabindex'] = '0';
					$label = isset($page['label']) ? $page['label'] : '';
					if (!isset($page['escape']) || $page['escape'] !== false)
					{
						$label = $this->escape($label);
					}
					if (!isset($page['translate']) || $page['translate'] !== false)
					{
						$label = $this->translate($label);
					}
					$icon = isset($page['icon']) ? '<span class="'.$page['icon'].'" aria-hidden="true"></span> ' : '';
					$attr['class'] = implode(' ', $attr['class']);
					$html[] = "\t".$tabDepth.'<' . $tag . ' ' . $this->createAttributesString($attr) . '>' . $icon . $label . '</' . $tag . '>';
					if (!empty($subNav))
					{
						$html[] = "\t".$tabDepth.'<a class="dropdown-toggle-mobile" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>';
						$html[] = $subNav;
					}
					$html[] = "".$tabDepth.'</li>';
				}
				if (count($html) == 0)
				{
					return '';
				}
				$navClass = [];
				$navClass[] = $depth == 0 ? 'nav navbar-nav' : 'dropdown-menu';
				$role = $depth == 0 ? '' : 'role="menu"';
				array_unshift($html, preg_replace("/\t/", "" , $tabDepth, 1)."<ul class=\"" . implode(' ', $navClass) . "\" ".$role.">");
				$html[] = preg_replace("/\t/", "" , $tabDepth, 1).'</ul>';
				return implode("\n\t\t\t",$html);
			}

			public function renderSkipNavigation(){
				// Render skip-nav
				// @return string
				return '
					<!-- skip-nav -->
					<div class="skip-nav"><a href="#main-content">Skip to main content</a></div>
					<!-- /skip-nav -->';
			}

			public function renderNavbarMenu(){
				// Render navbar-menu
				// @return string
				if ($this->getOption('show_navbar_menu') !== true)
				{
					return '';
				}
				$navCaps = $this->getOption('navbar_caps') ? ' navbar-caps' : '';
				$navAffix = $this->getOption('navbar_menu_affix') ? ' navbar-menu-affix' : '';

				return ' 
					<!-- navbar-menu -->
					<div class="navbar-menu-wrapper">
					<nav class="navbar navbar-menu navbar-default navbar-static-top no-border'.$navCaps.$navAffix.'" role="navigation">
						'.$this->renderContainerStart().'
							<div class="collapse navbar-collapse" id="navbar-menu-collapse">'.
								$this->renderNav($this->getOption('navbar_menu')).'
							</div>
							
							
						'.$this->renderContainerEnd().'
					</nav>
					</div>
					<!-- /navbar-menu -->';
			}

			public function renderNavbarslabs(){
				// Render navbar-slabs
				// @return string

				if ($this->getOption('show_navbar_slabs') !== true)
				{
					return '';
				}
				return implode("\n", [
					$this->renderNavbarslabsStart(),
					$this->renderNavbarslabsLeft(),
					$this->renderNavbarslabsRight(),
					$this->renderNavbarslabsEnd(),
				]);
			}

			public function renderNavbarslabsStart() {
				// Render navbar-slabs start
				// @return string
				return ' 
					<!-- navbar-slabs -->
					<nav class="navbar-slabs">
						'.$this->renderContainerStart();
			}

			public function renderNavbarslabsLeft(){
				// Render navbar-slabs left
				// @return string
				$index = [];
				foreach (range('A', 'Z') as $l)
				{
					$index[] = "\n\t\t\t\t\t<li><a href=\"http://www.iastate.edu/index/" . $l . "/\">" . $l . "</a></li>";
				}
				$index = implode('', $index);
				return '

				<!-- navbar-slabs-left -->
				<ul class="nav navbar-nav navbar-slabs-left">
					<li><a href="http://iastate.edu">iastate.edu</a></li>
					<li class="dropdown dropdown-hover isu-index">
						<a href="http://www.iastate.edu/index/A" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false">Index</a>
						<ul class="dropdown-menu isu-index-alpha">'.$index.'
						</ul>
					</li>
				</ul>
				<!-- /navbar-slabs-left -->';
			}

			public function renderNavbarslabsRight(){
				// Render navbar-slabs right
				// @return string
				return '

				<!-- navbar-slabs-right -->
				<ul class="nav navbar-nav navbar-right navbar-slabs-right">
					<li><a href="http://info.iastate.edu/">Directory</a></li>
					<li><a href="http://www.fpm.iastate.edu/maps/">Maps</a></li>
					<li><a href="http://web.iastate.edu/safety/">Safety</a></li>
					<li class="dropdown dropdown-hover">
						<a href="https://www.it.iastate.edu/signons/" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false">Sign Ons</a>
						<ul class="dropdown-menu">
							<li><a href="http://accessplus.iastate.edu/">AccessPlus</a></li>
							<li><a href="http://bb.its.iastate.edu/">Blackboard</a></li>
							<li><a href="http://iastate.box.com/">CyBox</a></li>
							<li><a href="http://cymail.iastate.edu/">CyMail</a></li>
							<li><a href="http://outlook.iastate.edu/">Outlook</a></li>
							<li><a href="https://www.it.iastate.edu/signons/">More Sign Ons...</a></li>
						</ul>
					</li>
				</ul>
				<!-- /navbar-slabs-right -->';
			}

			public function renderNavbarslabsEnd(){
				// Render /navbar-slabs
				// @return string
				return '

					</div>
					</nav>
				<!-- /navbar-slabs -->';
			}

			public function renderNavbarSite(){
				// Render navbar-site
				// @return string
				if ($this->getOption('show_navbar_site') !== true)
				{
					return '';
				}
				return implode("\n", [
					$this->renderNavbarSiteStart(),
					$this->renderNavbarSiteWordmark(),
					$this->renderNavbarSiteHeader(),
					$this->renderNavbarSiteSearch(),
					$this->renderNavbarSiteLinks(),
					$this->renderNavbarSiteEnd(),
				]);
			}

			public function renderNavbarSiteStart(){
				// Render navbar-site start
				// @return string
				return ' 

				<!-- navbar-site -->
				<nav class="navbar-site">
					'.$this->renderContainerStart();
			}

			public function renderNavbarSiteWordmark(){
				// Render navbar-site-wordmark
				// @return string
				$html = '
				<div class="navbar-site-wordmark">';

				if ($this->getOption('site_url') !== null)
				{
					$html .= "\n\t\t\t<a href=\"" . $this->escape($this->render($this->getOption('site_url')) ? : '/') . '" title="Home" class="wordmark-unit">';
				}
				$html .= '
					<span class="wordmark-isu">Iowa State University</span>';

				if ($this->getOption('show_site_title') == true)
				{
					$html .= "\n\t\t\t\t<span class=\"wordmark-unit-title\">" . $this->escape($this->getOption('site_title')) . "</span>";
				}
				$html .= '
					</a>
				</div>';
				return $html;
			}

			public function renderNavbarSiteHeader(){
				// Render navbar-site-header
				// @return string
				return '

				<div class="navbar-header visible-xs visible-sm">
					<button id="navbar-menu-button" type="button" class="navbar-toggle navbar-toggle-left collapsed" data-toggle="collapse" data-target="#navbar-menu-collapse, #navbar-site-links-collapse" aria-expanded="false">
						<span class="navbar-toggle-icon menu-icon">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</span>
						<span class="navbar-toggle-label">
							Menu <span class="sr-only">Toggle</span>
						</span>
					</button>
					<button id="navbar-search-button" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-site-search-collapse" aria-expanded="false">
						<span class="navbar-toggle-icon search-icon"></span>
						<span class="navbar-toggle-label">
							Search <span class="sr-only">Toggle</span>
						</span>
					</button>
				</div>';
			}
			
			public function renderNavbarSiteSearch(){
				// Render navbar-site-search
				// @return string
				if ($this->getOption('show_search_box') !== true)
				{
					return '';
				}
				$html = [];
				$html[] = "\n\t\t" . '<div class="navbar-site-info collapse navbar-collapse" id="navbar-site-search-collapse">';
				$html[] = "\t\t\t" . '<form action="' . $this->getOption('search_action') . '" class="navbar-site-search" method="GET" role="search">';
				$html[] = "\t\t\t\t" . '<label for="search-input" class="sr-only">Search</label>';
				if (($value = $this->getOption('search_output')))
				{
					$html[] = "\t\t\t\t" . '<input name="output" type="hidden" value="' . $this->escape($value) . '">';
				}
				if (($value = $this->getOption('search_client')))
				{
					$html[] = "\t\t\t\t" . '<input name="client" type="hidden" value="' . $this->escape($value) . '">';
				}
				if (($value = $this->getOption('search_site')))
				{
					$html[] = "\t\t\t\t" . '<input name="sitesearch" type="hidden" value="' . $this->escape($value) . '">';
				}
				if (($value = $this->getOption('search_style')))
				{
					$html[] = "\t\t\t\t" . '<input name="proxystylesheet" type="hidden" value="' . $this->escape($value) . '">';
				}
				$html[] = "\t\t\t\t" . '<input name="q" id="search-input" aria-label="Text input for search" title="Search" placeholder="' . $this->escape($this->getOption('search_placeholder')) . '" tabindex="0" type="text" class="form-control">';
				$html[] = "\t\t\t\t" . '<input class="hidden" title="Submit" type="submit" value="' . $this->escape($this->getOption('search_submit')) . '">';
				$html[] = "\t\t\t\t" . '<span class="search-icon"></span>';
				$html[] = "\t\t\t" . '</form>';
				$html[] = "\t\t" . '</div>';
				return implode("\n", $html);
			}

			public function renderNavbarSiteLinks(){
				// Render navbar-site-links
				// @return string
				if ($this->getOption('show_site_links') !== true)
				{
					return '';
				}
				$navCaps = $this->getOption('navbar_caps') ? ' navbar-caps' : '';
				$html = [];
				$html[] = "\n\t\t" . '<div class="navbar-site-info collapse navbar-collapse'.$navCaps.'" id="navbar-site-links-collapse">';
				$html[] = "\t\t\t" . '<ul class="nav navbar-nav navbar-right">';
				if(!empty($this->getOption('site_links')))
				{
					foreach ($this->getOption('site_links') as $link)
					{
						$icon = isset($link['icon']) ? '<span class="' . $link['icon'] . '" aria-hidden="true"></span> ' : '';
						if (isset($link['uri']) || isset($link['route']))
						{

							if (isset($link['uri']))
							{
								$link['href'] = $this->render($link['uri']);
							}
							elseif (isset($link['route']))
							{
								$link['href'] = $this->url($link['route']);
							}
						}

						$html[] = "\t\t\t\t<li><a href=\"" . $link['href'] . "\">" . $icon . $this->escape($link['label']) . "</a></li>";
					}
				}
				$html[] = "\t\t\t" . '</ul>';
				$html[] = "\t\t" . '</div>';
				return implode("\n", $html);
			}

			public function renderRightNav(){
				$targets = $this->getOption('right_nav');
				if ($targets === null || empty($targets))
				{
					return;
				}
				$attrs = [
					'class' => 'right-nav hidden-sm hidden-xs',
				];
				if ($this->getOption('right_nav_scroll_spy') === true)
				{
					$attrs['id'] = 'right-nav-scroll-spy';
				}
				if ($this->getOption('right_nav_collapse') === true)
				{
					$attrs['class'] .= ' right-nav-collapse';
				}
				if ($this->getOption('right_nav_affix') === true || $this->getOption('right_nav_scroll_spy') === true)
				{
					$attrs['data-spy'] = 'affix';
					if ($this->getOption('navbar_menu_affix'))
					{
						$attrs['class'] .= ' nav-menu-affixed';
					}
				}
				$rightNav = '
					<nav '.$this->createAttributesString($attrs).'>
						'.$this->renderScrollTargetList($targets).'
					</nav>';
				$this->setOption('right_sidebar', $rightNav . $this->getOption('right_sidebar'));
			}
			
			public function renderNavbarSiteEnd(){
				// Render navbar-site end
				// @return string
				return '

				'.$this->renderContainerEnd().'
				</nav>
				<!-- /navbar-site -->';
			}

			public function renderPostNav(){
				// Render hero background image
				// @return string
				$html = $this->getOption('post_nav');
				return '
					<div id="post-nav">
						'.$html.'
					</div>';
			}

	//=============================================================================================================================================

			//==== MAIN BODY ====\\

		//=============================================================================================================================================

			//==== FOOTER ====\\
			public function renderFooter(){
				// Render <footer>
				// @return string
				if ($this->getOption('show_footer') !== true)
				{
					return '';
				}
				return implode("\n\n", [
					$this->renderFooterStart(),
					$this->renderFooterAssociates(),
					$this->renderFooterContact(),
					$this->renderFooterSocial(),
					$this->renderFooterLegal(),
					$this->renderFooterEnd(),
				]);
			}

			public function drawFooter(){
				// Render  foot (post-content functions)
				// @return
				echo $this->renderContentEnd();
				echo $this->renderFooter();
				echo $this->renderLoadingBar();
				echo $this->renderInlineScript();
				echo $this->renderBodyEnd();
				echo $this->renderHtmlEnd();
				return $this;
			}
	
			public function renderFooterStart() {
				// Render <footer> start
				// @return string
				return '

				<!-- footer -->
				<footer role="contentinfo">
					'.$this->renderContainerStart().'
						<div class="row">';
			}

			public function renderFooterAssociates() {
				//	Render footer-associates
				//	@return string
				$linkList = "";
				foreach ($this->getOption('footer_associates') as $link)
				{
					$linkList .= "\n\t\t\t\t\t" . '<li><a target="_blank" href="' . $link['url'] . '">' . $link['label'] . '</a></li>';
				}
				return '
					<!-- footer-associates -->
					<section class="footer-associates col-sm-12 col-md-3">
						<ul>
							<li><a target="_blank" href="http://iastate.edu"><img src="//cdn.theme.iastate.edu/img/isu-stacked.svg" class="wordmark-isu" alt="Iowa State University"></a></li>'.$linkList.'
						</ul>
					</section>';
			}
			
			public function renderFooterContact(){
				//	Render footer-contact
				//	@return string
				$info = $this->getOption('footer_created_by');
				$names = $info['names'];
				$emails = $info['emails'];
				
				$ret = '<section class="footer-contact col-sm-12 col-md-3">
					<b>Created By:</b>
				';
				
				for($i = 0; $i<count($names); $i++){
					$ret .= '<br><a target="_blank" href="mailto:'.$emails[$i].'"">'.$names[$i].'</a>';
				}
						
				$ret .=	'
					<p>'.$info['time'].'</p>
					</section>
				';

				return $ret;
			}

			public function renderFooterSocial(){
				//	Render footer-social
				//	@return string
				$socialList = '';
				$rowBreak = 6;
				$numLinks = count($this->getOption('footer_social'));
				$labelClass = $this->getOption('show_social_labels') ? ' labeled' : ' unlabeled';
				$extras = '';
				if ($numLinks > $rowBreak && ($numLinks%$rowBreak) && !$this->getOption('show_social_labels'))
				{
					for($i = 0; $i < $rowBreak-$numLinks%$rowBreak; $i++)
					{
						$extras .= '<li></li>';
					}
				}
				foreach ($this->getOption('footer_social') as $social)
				{
					$label = $this->getOption('show_social_labels') ? $social['label']: '' ;
					$class='';
					if (isset($social['html']) && $social['html'])
					{
						$socialList.= "<li>\n".$social['html']."\n</li>";
						continue;
					}
					if(isset($social['icon']) && $social['icon'])
					{
						$class = 'class="fa fa-'.$social['icon'].'"';
					}
					$title = $this->getOption('show_social_labels') ? '' : ' title="{'.$social['label'].'"';
					$socialList .= '

							<li><a href="'.$social['url'].'"'.$title.$class.'>'.$label.'</a></li>';
				}
				return '
					<!-- footer-social -->
					<section class="footer-social col-sm-12 col-md-3">
						<ul class="'.$labelClass.'">'.$socialList.$extras.'
						</ul>
					</section>';
			}

			public function renderFooterLegal(){
				//	Render footer-legal
				//	@return string
				$statement = $this->getOption('footer_legal')['statement'];
				$linkList = "";
				foreach ($this->getOption('footer_legal')['links'] as $link)
				{
					$linkList .= "\n\t\t\t\t\t" . '<li><a href="' . $link['url'] . '">' . $link['label'] . '</a></li>';
				}
				return '
					<!-- footer-legal -->
					<section class="footer-legal col-sm-12 col-md-3">
						<p>'.$statement.'</p>
						<ul>'.$linkList.'
						</ul>
					</section>';
			}

			public function renderFooterEnd(){
				//	Render <footer> end
				//	@return string
				return '
				</div>
				</div>
				</footer>
				<!-- /footer -->';
			}

	//=============================================================================================================================================

		//==== SCRIPTS AND STYLING ====\\
		public function renderInlineScript(){
			// Render </body> <script>s
			// @return string
			return $this->renderScript($this->getOption('inline_script', []));
		}

		public function renderScript(array $config){
			// Render <script> tags from the given config options.
			// @param array $config
			// @throws InvalidArgumentException if incorrect $mode is found
			// @return string
			$html = [];
			foreach ($config as $mode => $items)
			{
				if ($mode != 'file' && $mode != 'script')
				{
					throw new InvalidArgumentException(sprintf(
						"Expected \$mode to be 'file' or 'script', got '%s' instead"
						, $mode
					));
				}
				$index = $this->sort($items);
				foreach ($index as $name)
				{
					$spec = $items[$name];
					if (is_callable($spec))
					{
						$spec = call_user_func($spec, $this);
					}
					if (is_null($spec))
					{
						continue;
					}
					if ($mode == 'file')
					{
						if (is_string($spec))
						{
							$spec = [
								'src' => $spec,
							];
						}
						if (isset($spec['src']))
						{
							$spec['src'] = $this->render($spec['src']);
						}
						unset($spec['order']);
						$html[] = "\t<script " . $this->createAttributesString($spec) . "></script>";
					}
					elseif ($mode == 'script')
					{
						if (is_string($spec))
						{
							$spec = [
								'content' => $spec,
								'attributes' => [],
							];
						}
						$html[] = "\t<script " . $this->createAttributesString($spec['attributes']) . ">" . $spec['content'] . "</script>";
					}
				}
			}
			return implode("\n", $html);
		}

	//=============================================================================================================================================

		//==== CONTAINERS ====\\
		public function renderContainerStart(){
			// Render container start
			// @return string
				$fluid='';
				if($this->getOption('full_width'))
				{
					$fluid = '-fluid';
				}
				return '
					<div class="container'.$fluid.'">';			
		}

		public function renderContainerEnd(){
			// Render container end
			// @return string
			return '</div>';
		}
}