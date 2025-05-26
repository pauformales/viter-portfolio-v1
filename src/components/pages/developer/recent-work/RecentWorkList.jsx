import React from "react";

import * as Yup from "yup";
import Footer from "../../../partials/Footer";
import Header from "../../../partials/Header";
import Navigation from "../Navigation";
import BreadCrumbs from "../../../partials/BreadCrumbs";
import RecentWorkListTable from "./RecentWorkListTable";
import ModalAddSettingsRecentWork from "./ModalAddSettingsRecentWork";
import { FaPlus } from "react-icons/fa6";

const RecentWorkList = () => {
  const [itemEdit, setItemEdit] = React.useState(null);
  const [isModalRecentWork, setIsModalRecentWork] = React.useState(false);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalRecentWork(true);
  };

  const currentMenu = location.pathname.startsWith("/recent-work")
    ? "/receny-twork-list"
    : "";

  return (
    <>
      <Header />

      <Navigation menu="recent-work" subMenu="recent-work" />

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
          <h2 className="text-base">Recent Work</h2>
          <div className="pt-3">
            <RecentWorkListTable
              setItemEdit={setItemEdit}
              setIsModal={setIsModalRecentWork}
            />
          </div>
        </div>

        {/*FOOTER*/}
        <Footer />

        {isModalRecentWork && (
          <ModalAddSettingsRecentWork
            itemEdit={itemEdit}
            setIsModal={setIsModalRecentWork}
          />
        )}
      </div>
    </>
  );
};

export default RecentWorkList;
