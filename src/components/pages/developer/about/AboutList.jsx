import React from "react";

import * as Yup from "yup";
import Footer from "../../../partials/Footer";
import Header from "../../../partials/Header";
import Navigation from "../Navigation";
import BreadCrumbs from "../../../partials/BreadCrumbs";
import AboutListTable from "./AboutListTable";
import ModalAddSettingsAbout from "./ModalAddSettingsAbout";
import { FaPlus } from "react-icons/fa6";

const AboutList = () => {
  const [itemEdit, setItemEdit] = React.useState(null);
  const [isModalAbout, setIsModalAbout] = React.useState(false);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalAbout(true);
  };

  const currentMenu = location.pathname.startsWith("/about")
    ? "/about-list"
    : "";

  return (
    <>
      <Header />

      <Navigation menu="about" subMenu="about" />

      <div className="wrapper ">
        {/*BREADCRUMBS OR ADD BUTTON*/}

        <div className="flex items-center justify-between py-2">
          <BreadCrumbs param={location.search} />

          <button
            type="button"
            className="flex items-center gap-x-1 text-white hover:underline text-sm"
            onClick={handleAdd}
          >
            <FaPlus />
            <span>Add</span>
          </button>
        </div>

        {/*CONTENT*/}
        <div className="pb-8">
          <h2 className="text-base">About</h2>
          <div className="pt-3">
            <AboutListTable
              setItemEdit={setItemEdit}
              setIsModal={setIsModalAbout}
            />
          </div>
        </div>

        {/*FOOTER*/}
        <Footer />

        {isModalAbout && (
          <ModalAddSettingsAbout
            itemEdit={itemEdit}
            setIsModal={setIsModalAbout}
          />
        )}
      </div>
    </>
  );
};

export default AboutList;
