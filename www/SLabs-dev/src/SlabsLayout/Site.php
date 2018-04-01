<?php
namespace Site;

$path = getenv("HTTP_SERVER_PATH");

class Theme extends \slabsTheme\Theme
{
    public function init()
    {	
    	global $path;
    	
        $this->setOptions(array(
            'theme_asset_path' => $path.'/slabs',
            'site_title' => 'Civil, Constuction, and Environmental Engineering',
            'site_links' => array(
                array(
                    'label' => 'Contact (Douglas Wood)',
                    'uri' => 'mailto:dwoody@iastate.edu',
                ),
            ),
            'show_page_title' => false,
            'footer_associates' => array(
                array(
                    'label' => null,
                    'url' => '',
                ),
                array(
                    'label' => 'Structural Testing Facilities',
                    'url' => 'https://www.ccee.iastate.edu/research/facilities/structural-engineering-lab/',
                ),
            ),
            'show_social_labels' => true,
            'footer_social' => array(
                array(
                    'label' => 'Facebook',
                    'url' => 'http://facebook.com/IowaStateU/',
                ),
                array(
                    'label' => 'Twitter',
                    'url' => 'http://twitter.com/iowastateu?lang=en',
                ),
                array(
                    'label' => 'Instagram',
                    'url' => 'http://instagram.com/iowastateu/',
                ),
                array(
                    'label' => 'YouTube',
                    'url' => 'http://youtube.com/user/iowastateu',
                ),
                array(
                    'label' => 'RSS',
                    'url' => 'http://www.news.iastate.edu/rss/rss.php',
                ),
            ),
            'footer_legal' => array(
                'statement' => 'Copyright © by C.A. Desings<br>
                                Iowa State University of Science and Technology<br>
                                All rights reserved',
                'links' => array(
                    array(
                        'label' => 'Privacy Policy',
                        'url' => 'http://www.policy.iastate.edu/electronicprivacy',
                    ),
                    array(
                        'label' => 'Digital Access & Accessibility',
                        'url' => 'http://digitalaccess.iastate.edu',
                    ),
                ),
            ),
        ));
    }
}
