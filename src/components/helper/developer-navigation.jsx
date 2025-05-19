import { FaCogs, FaHandHoldingHeart, FaList } from "react-icons/fa";
import { FaChildren, FaDashcube } from "react-icons/fa6";

export const developerNavigation = [
  {
    name: "DashBoard",
    code: "dashboard",
    link: "/dashboard",
  },

  {
    name: "About",
    code: "about",
    link: "/about",
  },
  {
    name: "Recent Work",
    code: "recent-work",
    link: "/recent-work",
  },
  {
    name: "Testimonials",
    code: "testimonials",
    link: "/testimonials",
  },
  {
    name: "Services",
    code: "services",
    link: "/services",
  },

  {
    name: "settings",
    code: "settings",
    icon: <FaCogs />,
    isDropDown: true,
    subMenu: [
      {
        name: "experience",
        code: "experience",
        link: "/settings/experience",
      },

      {
        name: "my service",
        code: "service",
        link: "/settings/service",
      },
    ],
  },
];
