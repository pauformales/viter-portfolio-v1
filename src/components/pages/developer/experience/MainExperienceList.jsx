import React from "react";

import { FaPlus } from "react-icons/fa";

import * as Yup from "yup";

import MainExperienceListTable from "./MainExperienceListTable";
import ModalAddMainExperience from "./ModalAddMainExperience";
import Header from "../../../partials/Header";
import Navigation from "../Navigation";
import Footer from "../../../partials/Footer";
import BreadCrumbs from "../../../partials/BreadCrumbs";

const MainExperienceList = () => {
  const [itemEdit, setItemEdit] = React.useState(null);
  const [isModalExperience, setIsModalExperience] = React.useState(false);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalExperience(true);
  };

  const currentMenu = location.pathname.startsWith("/mainexperience")
    ? "/mainexperience"
    : "";

  return (
    <>
      <Header />
      <Navigation menu="experience" />

      <div className="wrapper bg-secondary">
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
          <h2 className="text-base text-white">Experience</h2>
          <div className="pt-3">
            <MainExperienceListTable
              setItemEdit={setItemEdit}
              setIsModal={setIsModalExperience}
            />
          </div>
        </div>

        {/*FOOTER*/}
        <Footer />

        {isModalExperience && (
          <ModalAddMainExperience
            itemEdit={itemEdit}
            setIsModal={setIsModalExperience}
          />
        )}
      </div>
    </>
  );
};

export default MainExperienceList;
