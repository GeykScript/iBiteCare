import './bootstrap';


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
        BadgeQuestionMark,
        Search,
        Plus,
        AlignJustify,
        IdCard,
        SquareUser,     
        LockKeyhole,
        Eye,
        EyeOff,
        X,
        Check,
        SquarePen,
        ChevronLeft,        
        Boxes,
        StretchHorizontal,
        User
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
    BadgeQuestionMark,
    Search,
    Plus,
    AlignJustify,
    IdCard,
    SquareUser,
    LockKeyhole,
    Eye,
    EyeOff,
    X,
    Check,
    SquarePen,
    ChevronLeft,
    Boxes,
    StretchHorizontal,
    User
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


