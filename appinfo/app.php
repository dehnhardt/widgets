<?php

/**
 * Nextcloud - widget
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Holger Dehnhardt <holger@dehnhardt.org>
 * @copyright Holger Dehnhardt 2016
 */
namespace OCA\Widget\AppInfo;

use OCP\AppFramework\App;

require_once __DIR__ . '/autoload.php';

$app = new App( 'widget' );
$container = $app->getContainer();

$container->query( 'OCP\INavigationManager' )->add( function () use ($container) {
	\OCP\Util::writeLog( 'Widgets', 'Widgets: app.php', \OCP\Util::DEBUG );
	
	$urlGenerator = $container->query( 'OCP\IURLGenerator' );
	$l10n = $container->query( 'OCP\IL10N' );
	return [
			// the string under which your app will be referenced in Nextcloud
			'id' => 'widget',
			
			// sorting weight for the navigation. The higher the number, the higher
			// will it be listed in the navigation
			'order' => 10,
			
			// the route that will be shown on startup
			'href' => $urlGenerator->linkToRoute( 'widget.page.index' ),
			
			// the icon that will be shown in the navigation
			// this file needs to exist in img/
			'icon' => $urlGenerator->imagePath( 'widget', 'app.svg' ),
			
			// the title of your application. This will be used in the
			// navigation or on the settings page of your app
			'name' => $l10n->t( 'Widget' ) 
	];
} );

$listener = function ($event) {
	\OCP\Util::writeLog( 'Widgets', 'Widtgest callwidgets ' . print_r( $event, true ), \OCP\Util::DEBUG );
	;
};

$dispatcher = \OC::$server->getEventDispatcher();
\OCP\Util::writeLog( 'Widgets', 'Widgets dispatcher requested', \OCP\Util::DEBUG );

if ($dispatcher) {
	\OCP\Util::writeLog( 'Widgets', 'Widgets before add listener', \OCP\Util::DEBUG );
	$dispatcher->addListener( 'OCA\Dashboard\RequestWidget', $listener );
	\OCP\Util::writeLog( 'Widgets', 'Widgets after add listener', \OCP\Util::DEBUG );
}
