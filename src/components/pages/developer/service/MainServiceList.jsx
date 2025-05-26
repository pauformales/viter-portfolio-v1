import React from "react";

import { FaPlus } from "react-icons/fa";

import * as Yup from "yup";

import MainServiceListTable from "./MainServiceListTable";
import ModalAddMainService from "./ModalAddMainService";
import Header from "../../../partials/Header";
import Navigation from "../Navigation";
import Footer from "../../../partials/Footer";
import BreadCrumbs from "../../../partials/BreadCrumbs";

const MainServiceList = () => {
  const [itemEdit, setItemEdit] = React.useState(null);
  const [isModalService, setIsModalService] = React.useState(false);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalService(true);
  };

  const currentMenu = location.pathname.startsWith("/mainservice")
    ? "/mainservice"
    : "";

  return (
    <>
      <Header />
      <Navigation menu="service" />

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
          <h2 className="text-base ">Service</h2>
          <div className="pt-3">
            <MainServiceListTable
              setItemEdit={setItemEdit}
              setIsModal={setIsModalService}
            />
          </div>
        </div>

        {/*FOOTER*/}
        <Footer />

        {isModalService && (
          <ModalAddMainService
            itemEdit={itemEdit}
            setIsModal={setIsModalService}
          />
        )}
      </div>
    </>
  );
};

export default MainServiceList;
