
import { regions, provinces, cities, barangays } from "select-philippines-address";

document.addEventListener("DOMContentLoaded", () => {
    const dropdowns = [
        { btn: "region_btn", list: "region", selected: "region_selected", input: "region_input" },
        { btn: "province_btn", list: "province", selected: "province_selected", input: "province_input" },
        { btn: "city_btn", list: "city", selected: "city_selected", input: "city_input" },
        { btn: "barangay_btn", list: "barangay", selected: "barangay_selected", input: "barangay_input" },
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
        renderList("region", data, handleRegionSelect);

        //  Automatically select Region V (Bicol Region)
        // const region5 = data.find(r => r.region_code === "05"); // Region V
        // if (region5) {
        //     handleRegionSelect(region5);
        // }
    });

    // ---------------- Handlers ----------------
    function handleRegionSelect(region) {
        document.getElementById("region_selected").textContent = region.region_name;
        document.getElementById("region_input").value = region.region_name;

        resetDropdown("province");
        resetDropdown("city");
        resetDropdown("barangay");
        enableButton("province_btn");

        provinces(region.region_code).then(provData => {
            renderList("province", provData, handleProvinceSelect);
        });
    }

    function handleProvinceSelect(province) {
        document.getElementById("province_selected").textContent = province.province_name;
        document.getElementById("province_input").value = province.province_name;

        resetDropdown("city");
        resetDropdown("barangay");
        enableButton("city_btn");

        cities(province.province_code).then(cityData => {
            renderList("city", cityData, handleCitySelect);
        });
    }

    function handleCitySelect(city) {
        document.getElementById("city_selected").textContent = city.city_name;
        document.getElementById("city_input").value = city.city_name;

        resetDropdown("barangay");
        enableButton("barangay_btn");

        barangays(city.city_code).then(brgyData => {
            renderList("barangay", brgyData, handleBarangaySelect);
        });
    }

    function handleBarangaySelect(barangay) {
        document.getElementById("barangay_selected").textContent = barangay.brgy_name;
        document.getElementById("barangay_input").value = barangay.brgy_name;
    }

    // ---------------- Helpers ----------------
    function resetDropdown(type) {
        document.getElementById(`${type}_selected`).textContent = `Select ${capitalize(type)}`;
        document.getElementById(`${type}_input`).value = "";
        document.getElementById(type).innerHTML = "";
        disableButton(`${type}_btn`);
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










document.addEventListener("DOMContentLoaded", function() {
        const date_of_birth = document.getElementById("date_of_birth");
        const age = document.getElementById("age");

        date_of_birth.addEventListener("change", function() {
            const birthdate = new Date(date_of_birth.value);
            const today = new Date();
            let calculatedAge = today.getFullYear() - birthdate.getFullYear();
            const monthDifference = today.getMonth() - birthdate.getMonth();

            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthdate.getDate())) {
                calculatedAge--;
            }

            age.value = calculatedAge;
        });
    });

    function formatContactNumber(input) {
        let value = input.value.replace(/\D/g, ""); // remove non-digits

        if (value.length > 4 && value.length <= 7) {
            value = value.replace(/(\d{4})(\d+)/, "$1 $2");
        } else if (value.length > 7) {
            value = value.replace(/(\d{4})(\d{3})(\d+)/, "$1 $2 $3");
        }

        input.value = value;
    }

    const contactInput = document.getElementById("contact_number");

    // Format while typing
    contactInput.addEventListener("input", function(e) {
        formatContactNumber(e.target);
    });

    // Format immediately on page load if value exists
    window.addEventListener("DOMContentLoaded", function() {
        if (contactInput.value) {
            formatContactNumber(contactInput);
        }
    });