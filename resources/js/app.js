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

    // If not all elements exist, stop running
    if (!sidebar || !toggleButton || !closeButton || !mainContent) return;

    const toggleSidebar = () => {
        const isHidden = sidebar.classList.contains("-translate-x-full");

        if (window.innerWidth >= 768) {
            sidebar.classList.toggle("hidden");
            mainContent.classList.toggle("md:ml-56");
            closeButton.classList.toggle("hidden", sidebar.classList.contains("hidden"));
        } else {
            sidebar.classList.toggle("-translate-x-full");
            sidebar.classList.toggle("translate-x-0");
            closeButton.classList.toggle("hidden", !isHidden);
        }
    };

    toggleButton.addEventListener("click", toggleSidebar);

    closeButton.addEventListener("click", () => {
        if (window.innerWidth < 768) {
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("translate-x-0");
        } else {
            sidebar.classList.add("hidden");
            mainContent.classList.remove("md:ml-56");
        }
        closeButton.classList.add("hidden");
    });

    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove("-translate-x-full", "translate-x-0", "hidden");
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

            function setVh() {
                let vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            }
            setVh();
            window.addEventListener('resize', setVh);