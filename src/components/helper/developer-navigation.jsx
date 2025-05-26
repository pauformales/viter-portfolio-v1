import {
  FaBullhorn,
  FaCogs,
  FaFire,
  FaHandHoldingHeart,
  FaList,
  FaMeteor,
  FaPencilRuler,
  FaPray,
  FaRegKissWinkHeart,
} from "react-icons/fa";

export const developerNavigation = [
  {
    name: "DashBoard",
    code: "dashboard",
    link: "/dashboard",
    icon: <FaBullhorn />,
  },

  {
    name: "About",
    code: "about",
    link: "/about",
    icon: <FaMeteor />,
  },
  {
    name: "Recent Work",
    code: "recent-work",
    link: "/recent-work",
    icon: <FaFire />,
  },
  {
    name: "Testimonials",
    code: "testimonials",
    link: "/testimonials",
    icon: <FaPray />,
  },
  {
    name: "Experience",
    code: "experience",
    link: "/experience",
    icon: <FaRegKissWinkHeart />,
  },
  {
    name: "Services",
    code: "services",
    link: "/services",
    icon: <FaPencilRuler />,
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
