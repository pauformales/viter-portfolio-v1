import React from "react";
import { FaArrowLeft } from "react-icons/fa";
import { Link, useLocation, useNavigate } from "react-router-dom";

const BreadCrumbs = ({ param = "" }) => {
  const location = useLocation();
  const navigate = useNavigate();
  let currentLink = "";

  const crumbs = location.pathname
    .split("/")
    .filter((item) => item !== "")
    .map((item, key) => {
      currentLink += `/${item}`;
      return (
        <li
          className={`text-white after:mr-2 after:content-['>'] last:after:hidden last:text-white last:pointer-events-none ${
            (item === "settings" || item === "reports") && "pointer-events-none"
          }`}
          key={key}
        >
          <Link
            to={`${
              item === "settings" || item === "reports"
                ? ""
                : `${currentLink}${param}`
            }`}
            className="mr-2 hover:text-primary"
          >
            {item.replace("-", " ")}
          </Link>
        </li>
      );
    });

  return (
    <div className="flex itemscenter gap-x-3 pt-2">
      <button type="button">
        <FaArrowLeft className="h-4 w-4 text-accent" />
      </button>
      <ul className="flex items-center cursor-pointer text-[10px]">{crumbs}</ul>
    </div>
  );
};

export default BreadCrumbs;
