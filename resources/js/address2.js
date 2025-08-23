import { regions, provinces, cities, barangays } from "select-philippines-address";

document.addEventListener("DOMContentLoaded", () => {
    const dropdowns = [
        { btn: "update-region_btn", list: "update-region", selected: "update-region_selected", input: "update_region_input" },
        { btn: "update-province_btn", list: "update-province", selected: "update-province_selected", input: "update_province_input" },
        { btn: "update-city_btn", list: "update-city", selected: "update-city_selected", input: "update_city_input" },
        { btn: "update-barangay_btn", list: "update-barangay", selected: "update-barangay_selected", input: "update_barangay_input" },
    ];

    function toggleList(btn, list) {
        document.getElementById(list).classList.toggle("hidden");
    }

    function renderList(listId, items, onClick) {
        const listElement = document.getElementById(listId);
        listElement.innerHTML = "";
        items.forEach(item => {
            const li = document.createElement("li");
            li.textContent = item.region_name || item.province_name || item.city_name || item.brgy_name;
            li.dataset.code = item.region_code || item.province_code || item.city_code || item.brgy_code;
            li.className = "cursor-pointer px-3 py-2 hover:bg-gray-100";
            li.addEventListener("click", () => {
                onClick(item, li);
                listElement.classList.add("hidden");
            });
            listElement.appendChild(li);
        });
    }   

    dropdowns.forEach(dd => {
        const btn = document.getElementById(dd.btn);
        btn.addEventListener("click", () => toggleList(dd.btn, dd.list));
    });

    // Load Regions
    regions().then(data => {
        // Render regions in the update form dropdown
        renderList("update-region", data, handleRegionSelect);

        // Automatically select Region V (Bicol Region)
        // const region5 = data.find(r => r.region_code === "05"); // Region V
        // if (region5) {
        //     handleRegionSelect(region5);
        // }
    });

    // ---------------- Handlers ----------------
    function handleRegionSelect(region) {
        document.getElementById("update-region_selected").textContent = region.region_name;
        document.getElementById("update_region_input").value = region.region_name;

        resetDropdown("province");
        resetDropdown("city");
        resetDropdown("barangay");
        enableButton("update-province_btn");

        provinces(region.region_code).then(provData => {
            renderList("update-province", provData, handleProvinceSelect);
        });
    }

    function handleProvinceSelect(province) {
        document.getElementById("update-province_selected").textContent = province.province_name;
        document.getElementById("update_province_input").value = province.province_name;

        resetDropdown("city");
        resetDropdown("barangay");
        enableButton("update-city_btn");

        cities(province.province_code).then(cityData => {
            renderList("update-city", cityData, handleCitySelect);
        });
    }

    function handleCitySelect(city) {
        document.getElementById("update-city_selected").textContent = city.city_name;
        document.getElementById("update_city_input").value = city.city_name;

        resetDropdown("barangay");
        enableButton("update-barangay_btn");

        barangays(city.city_code).then(brgyData => {
            renderList("update-barangay", brgyData, handleBarangaySelect);
        });
    }

    function handleBarangaySelect(barangay) {
        document.getElementById("update-barangay_selected").textContent = barangay.brgy_name;
        document.getElementById("update_barangay_input").value = barangay.brgy_name;
    }

    // ---------------- Helpers ----------------
    function resetDropdown(type) {
        document.getElementById(`update-${type}_selected`).textContent = `Select ${capitalize(type)}`;
        document.getElementById(`update_${type}_input`).value = "";
        document.getElementById(`update-${type}`).innerHTML = "";
        disableButton(`update-${type}_btn`);
    }

    function enableButton(id) {
        const btn = document.getElementById(id);
        btn.classList.remove("opacity-50", "cursor-not-allowed");
    }

    function disableButton(id) {
        const btn = document.getElementById(id);
        btn.classList.add("opacity-50", "cursor-not-allowed");
    }

    function capitalize(word) {
        return word.charAt(0).toUpperCase() + word.slice(1);
    }
});