import './bootstrap';


// Recommended way, to include only the icons you need.
import {
     createIcons, 
        Menu,
        MapPin,
        PhoneCall,
        Phone,
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
        User,
        CircleCheck,
        Send,
        SendHorizontal,
        FileSpreadsheet,
        Sheet,
        Download
    } 
     from 'lucide';

createIcons({
  icons: {
    Menu,
    MapPin,
    PhoneCall,
    Phone,
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
    User,
    CircleCheck,
    Send,
    SendHorizontal,
    FileSpreadsheet,
    Sheet,
    Download
  }
}); 


document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const toggleButton = document.getElementById("toggleSidebar");
    const closeButton = document.getElementById("closeSidebar");
    const mainContent = document.getElementById("mainContent");

    const toggleSidebar = () => {
        const isHidden = sidebar.classList.contains("-translate-x-full");

        if (window.innerWidth >= 768) {
            // Desktop toggle (show/hide sidebar)
            sidebar.classList.toggle("hidden");
            mainContent.classList.toggle("md:ml-56");

            // Show or hide close button accordingly
            if (sidebar.classList.contains("hidden")) {
                closeButton.classList.add("hidden");
            } else {
                closeButton.classList.remove("hidden");
            }

        } else {
            // Mobile toggle (slide animation)
            sidebar.classList.toggle("-translate-x-full");
            sidebar.classList.toggle("translate-x-0");

            // Toggle close button visibility based on sidebar state
            if (isHidden) {
                closeButton.classList.remove("hidden");
            } else {
                closeButton.classList.add("hidden");
            }
        }
    };

    // Toggle button (☰)
    toggleButton.addEventListener("click", toggleSidebar);

    // Close button (mobile or desktop)
    closeButton.addEventListener("click", () => {
        if (window.innerWidth < 768) {
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("translate-x-0");
        } else {
            sidebar.classList.add("hidden");
            mainContent.classList.remove("md:ml-56");
        }
        // Always hide the close button when closing
        closeButton.classList.add("hidden");
    });

    // Handle window resize (keep consistent state)
    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove("-translate-x-full", "translate-x-0");
            sidebar.classList.remove("hidden");
            mainContent.classList.add("md:ml-56");
            closeButton.classList.add("hidden");
        } else {
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("hidden");
            mainContent.classList.remove("md:ml-56");
            closeButton.classList.add("hidden");
        }
    });
});