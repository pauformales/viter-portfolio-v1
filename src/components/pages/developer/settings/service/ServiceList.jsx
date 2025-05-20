import React from "react";

import { FaPlus } from "react-icons/fa";

import * as Yup from "yup";

import BreadCrumbs from "../../../../partials/BreadCrumbs";
import ModalAddSettingsService from "./ModalAddSettingsService";
import ServiceListTable from "./ServiceListTable";
import Header from "../../../../partials/Header";
import Navigation from "../../Navigation";
import Footer from "../../../../partials/Footer";

const ServiceList = () => {
  const [itemEdit, setItemEdit] = React.useState(null);
  const [isModalService, setIsModalService] = React.useState(false);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalService(true);
  };

  const currentMenu = location.pathname.startsWith("/service")
    ? "/service-list"
    : "";

  return (
    <>
      <Header />

      <Navigation menu="service" subMenu="service" />

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
          <h2 className="text-base">Service</h2>
          <div className="pt-3">
            <ServiceListTable
              setItemEdit={setItemEdit}
              setIsModal={setIsModalService}
            />
          </div>
        </div>

        {/*FOOTER*/}
        <Footer />

        {isModalService && (
          <ModalAddSettingsService
            itemEdit={itemEdit}
            setIsModal={setIsModalService}
          />
        )}
      </div>
    </>
  );
};

export default ServiceList;
