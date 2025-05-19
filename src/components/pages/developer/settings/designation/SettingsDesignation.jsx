import React from "react";
import Header from "../../../../partials/Header";
import Navigation from "../../Navigation";
import BreadCrumbs from "../../../../partials/BreadCrumbs";
import Footer from "../../../../partials/Footer";
import { FaPlus } from "react-icons/fa";
import SettingsDesignationList from "./SettingsDesignationList";
import ModalAddSettingsDesignation from "./ModalAddSettingsDesignation";

const SettingsDesignation = () => {
  const [isModalDesignation, setIsModalDesignation] = React.useState(false);
  const [itemEdit, setItemEdit] = React.useState(null);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalDesignation(true);
  };

  return (
    <>
      <Header />
      <Navigation menu="settings" subMenu="designation" />
      <div className="wrapper">
        {/* BREADCRUMBS OR ADD BUTTON */}
        <div className="flex items-center justify-between">
          <BreadCrumbs />
          <button
            type="button"
            className="flex items-center gap-x-3 text-primary hover:underline text-sm"
            onClick={handleAdd}
          >
            <FaPlus />
            <span>Add</span>
          </button>
        </div>

        {/* MAIN CONTENT */}
        <div className="pb-8">
          <h2>Designation</h2>
          <div className="pt-3">
            <SettingsDesignationList
              setItemEdit={setItemEdit}
              setIsModal={setIsModalDesignation}
            />
          </div>
        </div>

        {/* FOOTER */}
        <Footer />
      </div>

      {isModalDesignation && (
        <ModalAddSettingsDesignation
          itemEdit={itemEdit}
          setIsModal={setIsModalDesignation}
        />
      )}
    </>
  );
};

export default SettingsDesignation;
