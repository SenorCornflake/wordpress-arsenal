<?php
/*
 * Plugin Name: BKR Contacts
 * Author: Baker
 * Description: Display contact links in "zones" defined by the theme
 */


class BKR_Contacts {
	public function __construct() {
		add_action("admin_menu", function() {
			add_menu_page(
				"Edit Contacts",
				"BKR Contacts",
				"manage_options",
				"bkr_contacts_edit_contacts",
				function() {
					require_once plugin_dir_path(__FILE__)."/partials/edit-contacts.php";
				}
			);
		});
		add_action("admin_post_bkr_contacts_edit_contacts", [$this, "edit_contacts"]);
		add_action("wp_enqueue_scripts", function () {
			wp_enqueue_style(
				"bkr_contacts_default_style",
				plugin_dir_url(__FILE__)."/css/default-theme.css",
				[],
				false,
				"all"
			);
			wp_enqueue_style("dashicons");
		});
		add_action("admin_enqueue_scripts", function($hook) {
			if ($hook != "toplevel_page_bkr_contacts_edit_contacts") {
				return;
			}
			wp_enqueue_script(
				"bkr_contacts_edit_contacts",
				plugin_dir_url(__FILE__)."/js/edit-contacts.js",
				[],
				false,
				true
			);
			wp_enqueue_style(
				"bkr_contacts_edit_contacts",
				plugin_dir_url(__FILE__)."/css/edit-contacts.css",
				[],
				false,
				"all"
			);
		});
		add_action("bkr_contacts_zone", [$this, "display_zone"]);
	}

	public function display_zone($slug) {
		$zones = self::get_serialized_option("bkr_contacts_zones");

		foreach ($zones as $z) {
			if ($z["slug"] == $slug) {
				if ($z["contacts"] != null && sizeof($z["contacts"]) > 0) {
					$html = '<ul class="bkr_contacts_zone bkr_contacts_zone_'.$z['slug'].'">';

					foreach ($z["contacts"] as $c) {
						$html .= "<li>";
						$icon_html = "";
						$label_html = "";

						if (strlen($c["icon"]) > 0) {
							$icon_html .= '<span class="dashicons dashicons-'.$c["icon"].' bkr_contacts_contact_icon"></span>';
						}
						if (strlen($c["label"]) > 0) {
							$label_html .= '<span class="bkr_contacts_contact_label">'.$c["label"].'</span>';
						}

						if (strlen($c["link"]) > 0) {
							$html .= '<a href="'.$c["link"].'">'.$icon_html.$label_html."</a>";
						} else {
							$html .= $label_html;
						}

						$html .= "</li>";
					}

					$html .= "</ul>";
					echo $html;
				}
				break;
			}
		}
	}
	
	public function edit_contacts() {
		$registered_zones = self::get_serialized_option("bkr_contacts_zones");

		foreach ($registered_zones as &$z) {
			$contacts = $_POST["zones"][$z["slug"]]["contacts"];

			if ($contacts == null) {
				$z["contacts"] = [];
			} else {
				$z["contacts"] = $contacts;
			}
		}

		if (isset($_POST["remove"])) {
			foreach($_POST["remove"] as $r) {
				$r = explode(":", $r);

				foreach ($registered_zones as &$z) {
					if ($z["slug"] == $r[0]) {
						unset($z["contacts"][$r[1]]);
					}
				}
			}
		}
		
		update_option("bkr_contacts_zones", serialize($registered_zones));
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}

	private static function get_serialized_option($name) {
		$option = get_option($name, "");

		if (strlen($option) > 0) {
			return unserialize($option);
		} else {
			return [];
		}
	}

	public static function register_zone($slug, $name) {
		$zones = self::get_serialized_option("bkr_contacts_zones");
		$found_zone = false;

		foreach($zones as $z) {
			if ($z["slug"] == $slug) {
				$found_zone = true;
			}
		}

		if (!$found_zone) {
			array_push($zones, [
				"slug" => $slug,
				"name" => $name,
				"contacts" => []
			]);
		}
		
		update_option("bkr_contacts_zones", serialize($zones));
	}

	public static function display_edit_contacts_form_contents() {
		$html = "";
		$zones = self::get_serialized_option("bkr_contacts_zones");


		if (sizeof($zones) == 0) {
			echo "<h1>Your current theme does not support any contact link zones</h1>";
			return;
		}

		foreach ($zones as $z) {
			$zone_slug = $z["slug"];
			$html .= '<h1 class="bkr_contacts_zone_title">'.$z["name"].'</h1><div class="bkr_contacts_zone" id="bkr_contacts_zone_'.$zone_slug.'">';

			if (!isset($z["contacts"])) {
				$html .= "</div>";
				continue;
			}


			$html .= '<div class="bkr_contacts_contacts">';
			foreach ($z["contacts"] as $c) {
				$link  = $c["link"];
				$label = $c["label"];
				$icon  = $c["icon"];
				$slug  = $c["slug"];

				$html .= '<div class="bkr_contacts_contact">';
				$html .= '<h2 class="bkr_contacts_contact_title">'.$label."</h2>";

				$html .= '<div class="bkr_contacts_item">';
				$html .= '<label for="bkr_contacts_item_'.$slug.'_slug">Slug</label>';
				$html .= '<input type="text" id="bkr_contacts_item_'.$slug.'_slug" class="bkr_contacts_slug" name="zones['.$zone_slug.'][contacts]['.$slug.'][slug]" value="'.$slug.'">';
				$html .= "</div>";

				$html .= '<div class="bkr_contacts_item">';
				$html .= '<label for="bkr_contacts_item_'.$slug.'_link">Link</label>';
				$html .= '<input type="text" id="bkr_contacts_item_'.$slug.'_link" name="zones['.$zone_slug.'][contacts]['.$slug.'][link]" value="'.$link.'">';
				$html .= "</div>";

				$html .= '<div class="bkr_contacts_item">';
				$html .= '<label for="bkr_contacts_item_'.$slug.'_label">Label</label>';
				$html .= '<input type="text" id="bkr_contacts_item_'.$slug.'_label" name="zones['.$zone_slug.'][contacts]['.$slug.'][label]" value="'.$label.'">';
				$html .= "</div>";

				$html .= '<div class="bkr_contacts_item">';
				$html .= '<label for="bkr_contacts_item_'.$slug.'_icon">Icon</label>';
				$html .= '<input type="text" id="bkr_contacts_item_'.$slug.'_icon" name="zones['.$zone_slug.'][contacts]['.$slug.'][icon]" value="'.$icon.'">';
				$html .= "</div>";

				$html .= '<div class="bkr_contacts_item">';
				$html .= '<label for="bkr_contacts_item_'.$slug.'_remove">Remove?</label>';
				$html .= '<input type="checkbox" id="bkr_contacts_item_'.$slug.'_remove" name="remove[]" value="'.$zone_slug.':'.$slug.'">';
				$html .= "</div>";

				$html .= "</div>"; # contacts_contact
			}
			$html .= '</div>'; # contacts_contacts
			$html .= '<button type="button" class="button bkr_contacts_add_contact">Add Contact</button>';
			$html .= "</div>"; # contacts_zone
		}

		$html .= '<input type="hidden" name="action" value="bkr_contacts_edit_contacts">';
		$html .= '<button class="button button-primary" id="bkr_contact_submit" type="submit">Submit Changes</button>';
		echo $html;
	}
}

new BKR_Contacts();
