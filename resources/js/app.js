import './bootstrap';

import Alpine from 'alpinejs';


window.Alpine = Alpine;


Alpine.start();

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
  }
});


