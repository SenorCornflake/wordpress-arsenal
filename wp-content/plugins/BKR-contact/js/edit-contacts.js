let bkr_add_contact_btns = document.getElementsByClassName("bkr_contacts_add_contact");
let bkr_contacts_submit = document.getElementById("bkr_contacts_submit");
let bkr_contacts_form = document.getElementById("bkr_contacts_form");

bkr_contact_submit.addEventListener("click", function(e) {
	e.preventDefault();
	let alerted = false;

	for (const slug_input of document.getElementsByClassName("bkr_contacts_slug")) {
		if (slug_input.value.length < 1) {
			alert("A slug field connot be left empty!");
			alerted = true;
			break;
		}
	}

	if (!alerted) {
		bkr_contacts_form.submit();
	}
});

for (const btn of bkr_add_contact_btns) {
	btn.addEventListener('click', function() {
		let bkr_contacts_contacts = btn.parentElement.getElementsByClassName("bkr_contacts_contacts")[0];

		let zone_slug = btn.parentElement.id.replace("bkr_contacts_zone_", "");
		let innerhtml = "";
		let random_slug = Math.floor(Math.random() * 1000);

		let contact = document.createElement("div");
		contact.classList.add("bkr_contacts_contact");

		let contact_title = document.createElement("h2");
		contact_title.classList.add("bkr_contacts_contact_title");
		contact_title.innerText = "New";

		let slug_item = document.createElement("div");
		slug_item.classList.add("bkr_contacts_item");

		let slug_label = document.createElement("label");
		slug_label.setAttribute("for", "bkr_contacts_item_"+random_slug+"_slug");
		slug_label.innerText = "Slug";

		let slug_input = document.createElement("input");
		slug_input.classList.add("bkr_contacts_slug");
		slug_input.setAttribute("type", "text");
		slug_input.setAttribute("id", "bkr_contacts_item_"+random_slug+"_slug");
		slug_input.setAttribute("name", "zones["+zone_slug+"][contacts]["+random_slug+"][slug]");

		let link_item = document.createElement("div");
		link_item.classList.add("bkr_contacts_item");

		let link_label = document.createElement("label");
		link_label.setAttribute("for", "bkr_contacts_item_"+random_slug+"_link");
		link_label.innerText = "Link";

		let link_input = document.createElement("input");
		link_input.setAttribute("type", "text");
		link_input.setAttribute("id", "bkr_contacts_item_"+random_slug+"_link");
		link_input.setAttribute("name", "zones["+zone_slug+"][contacts]["+random_slug+"][link]");

		let label_item = document.createElement("div");
		label_item.classList.add("bkr_contacts_item");

		let label_label = document.createElement("label");
		label_label.setAttribute("for", "bkr_contacts_item_"+random_slug+"_label");
		label_label.innerText = "Label";

		let label_input = document.createElement("input");
		label_input.setAttribute("type", "text");
		label_input.setAttribute("id", "bkr_contacts_item_"+random_slug+"_label");
		label_input.setAttribute("name", "zones["+zone_slug+"][contacts]["+random_slug+"][label]");

		let icon_item = document.createElement("div");
		icon_item.classList.add("bkr_contacts_item");

		let icon_label = document.createElement("label");
		icon_label.setAttribute("for", "bkr_contacts_item_"+random_slug+"_icon");
		icon_label.innerText = "Icon";

		let icon_input = document.createElement("input");
		icon_input.setAttribute("type", "text");
		icon_input.setAttribute("id", "bkr_contacts_item_"+random_slug+"_icon");
		icon_input.setAttribute("name", "zones["+zone_slug+"][contacts]["+random_slug+"][icon]");

		let remove_item = document.createElement("div");
		remove_item.classList.add("bkr_contacts_item");

		let remove_label = document.createElement("label");
		remove_label.setAttribute("for", "bkr_contacts_item_"+random_slug+"_remove");
		remove_label.innerText = "Icon";

		let remove_input = document.createElement("input");
		remove_input.setAttribute("type", "checkbox");
		remove_input.setAttribute("id", "bkr_contacts_item_"+random_slug+"_remove");
		remove_input.setAttribute("name", "remove[]");
		remove_input.setAttribute("value", zone_slug+":"+slug_input.value);

		slug_item.appendChild(slug_label);
		slug_item.appendChild(slug_input);
		link_item.appendChild(link_label);
		link_item.appendChild(link_input);
		label_item.appendChild(label_label);
		label_item.appendChild(label_input);
		icon_item.appendChild(icon_label);
		icon_item.appendChild(icon_input);

		contact.appendChild(contact_title);
		contact.appendChild(slug_item);
		contact.appendChild(link_item);
		contact.appendChild(label_item);
		contact.appendChild(icon_item);
		bkr_contacts_contacts.appendChild(contact);

		function set_attributes(slug) {
			slug_input.setAttribute("id", "bkr_contacts_item_"+slug+"_slug");
			slug_input.setAttribute("name", "zones["+zone_slug+"][contacts]["+slug+"][slug]");
			slug_label.setAttribute("for", "bkr_contacts_item_"+slug+"_slug");

			link_input.setAttribute("id", "bkr_contacts_item_"+slug+"_link");
			link_input.setAttribute("name", "zones["+zone_slug+"][contacts]["+slug+"][link]");
			link_label.setAttribute("for", "bkr_contacts_item_"+slug+"_link");

			label_input.setAttribute("id", "bkr_contacts_item_"+slug+"_label");
			label_input.setAttribute("name", "zones["+zone_slug+"][contacts]["+slug+"][label]");
			label_label.setAttribute("for", "bkr_contacts_item_"+slug+"_link");

			icon_input.setAttribute("id", "bkr_contacts_item_"+slug+"_icon");
			icon_input.setAttribute("name", "zones["+zone_slug+"][contacts]["+slug+"][icon]");
			icon_label.setAttribute("for", "bkr_contacts_item_"+slug+"_link");

			remove_input.setAttribute("value", zone_slug+":"+slug_input.value);
		}

		slug_input.addEventListener("keyup", function() {
			set_attributes(slug_input.value);
		});
		label_input.addEventListener("keyup", function() {
			if (label_input.value.length > 0) {
				contact_title.innerText = label_input.value;
			} else {
				contact_title.innerText = "New";
			}
		});
	});
}
