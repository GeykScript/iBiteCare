import './bootstrap';
// import Alpine from 'alpinejs';

// window.Alpine = Alpine;
// Alpine.start();


// Recommended way, to include only the icons you need.
import {
     createIcons, 
        Menu,
        MapPin,
        PhoneCall,
        Mail,
        House,
        CircleChevronLeft,
        CalendarClock,
        Syringe,
        MapPinned,
        LocateFixed,
        LayoutDashboard,
        Users,
        MessageSquareText,
        NotebookPen,
        Package,
        PhilippinePeso,
        NotepadText,
        Logs,
        FileUser,
        FileBox,
        FileText,
        BriefcaseMedical,
        ChartColumnBig,
        CircleChevronRight,
        Info,
        BadgeInfo,
        ChevronRight,
        ChevronDown,
        SlidersHorizontal,
        CircleUser,
        LogOut,
        CircleQuestionMark,
        BadgeQuestionMark

    } 
     from 'lucide';

createIcons({
  icons: {
    Menu,
    MapPin,
    PhoneCall,
    Mail,
    House,
    CircleChevronLeft,
    CalendarClock,
    Syringe,
    MapPinned,
    LocateFixed,
    LayoutDashboard,
    Users,
    MessageSquareText,
    NotebookPen,
    Package,
    PhilippinePeso,
    NotepadText,
    Logs,
    FileUser,
    FileBox,
    FileText,
    BriefcaseMedical,
    ChartColumnBig,
    CircleChevronRight,
    Info,
    BadgeInfo,
    ChevronRight,
    ChevronDown,
    SlidersHorizontal,
    CircleUser,
    LogOut,
    CircleQuestionMark,
    BadgeQuestionMark

  }
});


// Sidebar toggle functionality
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const toggleSidebar = document.getElementById('toggleSidebar');
const closeSidebar = document.getElementById('closeSidebar');

// Create overlay for mobile
let overlay = document.getElementById('sidebarOverlay');
if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'sidebarOverlay';
    overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-40 hidden';
    document.body.appendChild(overlay);
}

// Detect screen size
function isMobile() {
    return window.innerWidth < 768;
}

// Open and close sidebar functions
function openSidebar() {
    sidebar.classList.remove('hidden');
    if (isMobile()) {
        overlay.classList.remove('hidden');
        mainContent.classList.remove('md:ml-56');
    } else {
        mainContent.classList.add('md:ml-56');
    }
}

function closeSidebarFunc() {
    sidebar.classList.add('hidden');
    overlay.classList.add('hidden');
    mainContent.classList.remove('md:ml-56');
}

// Event listeners for toggling sidebar
toggleSidebar.addEventListener('click', () => {
    if (sidebar.classList.contains('hidden')) {
        openSidebar();
    } else {
        closeSidebarFunc();
    }
});

// Event listeners for closing sidebar
closeSidebar.addEventListener('click', closeSidebarFunc);
overlay.addEventListener('click', closeSidebarFunc);

// Update sidebar visibility based on screen size
function updateSidebarState() {
    if (isMobile()) {
        sidebar.classList.add('hidden');
        overlay.classList.add('hidden');
        mainContent.classList.remove('md:ml-56');
    } else {
        sidebar.classList.remove('hidden');
        overlay.classList.add('hidden');
        mainContent.classList.add('md:ml-56');
    }
}

// Initial check for sidebar state
window.addEventListener('load', updateSidebarState);
window.addEventListener('resize', updateSidebarState);


// Function to display current date and time
    function updateDateTime() {
        const now = new Date();

        // Weekday and Month Names
        const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'
        ];

        const weekday = weekdays[now.getDay()];
        const month = months[now.getMonth()];
        const day = now.getDate();
        const year = now.getFullYear();

        // Format time
        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12 || 12; // Convert 0 to 12

        // Create formatted strings
        const weekdayString = `${weekday}`;
        const dateString = `${month} ${day}, ${year}`;
        const timeString = `${hours}:${minutes} ${ampm}`;

        // Update DOM
        document.getElementById('datetime').innerHTML = `${dateString} <br> ${weekdayString}, ${timeString}`;
    }

    // Update immediately and then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);


    