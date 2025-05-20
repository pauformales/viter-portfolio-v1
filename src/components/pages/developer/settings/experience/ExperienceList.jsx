import React from "react";

import * as Yup from "yup";
import Footer from "../../../../partials/Footer";
import Header from "../../../../partials/Header";
import Navigation from "../../Navigation";
import BreadCrumbs from "../../../../partials/BreadCrumbs";
import ExperienceListTable from "./ExperienceListTable";
import ModalAddSettingsExperience from "./ModalAddSettingsExperience";
import { FaPlus } from "react-icons/fa6";

const ExperienceList = () => {
  const [itemEdit, setItemEdit] = React.useState(null);
  const [isModalExperience, setIsModalExperience] = React.useState(false);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalExperience(true);
  };

  const currentMenu = location.pathname.startsWith("/experience")
    ? "/experience-list"
    : "";

  return (
    <>
      <Header />

      <Navigation menu="experience" subMenu="experience" />

      <div className="wrapper">
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
          <h2 className="text-base">My Experience</h2>
          <div className="pt-3">
            <ExperienceListTable
              setItemEdit={setItemEdit}
              setIsModal={setIsModalExperience}
            />
          </div>
        </div>

        {/*FOOTER*/}
        <Footer />

        {isModalExperience && (
          <ModalAddSettingsExperience
            itemEdit={itemEdit}
            setIsModal={setIsModalExperience}
          />
        )}
      </div>
    </>
  );
};

export default ExperienceList;
