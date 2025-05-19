import React from "react";
import Header from "../../../partials/Header";
import Navigation from "../Navigation";
import BreadCrumbs from "../../../partials/BreadCrumbs";
import { FaPlus } from "react-icons/fa6";
import Footer from "../../../partials/Footer";
import ChildrenListTable from "./ChildrenListTable";
import ModalAddSettingsChildren from "./ModalAddSettingsChildren";

const ChildrenList = () => {
  const [itemEdit, setItemEdit] = React.useState(null);
  const [isModalChildren, setIsModalChildren] = React.useState(false);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalChildren(true);
  };

  return (
    <>
      <Header />
      <Navigation menu="children-list" />
      {/* FOR TABLE */}
      <div className="wrapper">
        {/* BREADCRUMBS OR ADD BUTTON */}
        <div className="flex items-center justify-between py-2">
          <BreadCrumbs param={location.search} />
          <button
            type="button"
            className="flex items-center gap-x-1 text-primary hover:underline text-sm"
            onClick={handleAdd}
          >
            <FaPlus />
            <span>Add</span>
          </button>
        </div>

        {/* CONTENT */}
        <div className="pb-8">
          <h2 className="text-base">Children</h2>
          <div className="pt-3">
            <ChildrenListTable
              setItemEdit={setItemEdit}
              setIsModal={setIsModalChildren}
            />
          </div>
        </div>

        {/* FOOTER */}
        <Footer />

        {isModalChildren && (
          <ModalAddSettingsChildren
            itemEdit={itemEdit}
            setIsModal={setIsModalChildren}
          />
        )}
      </div>
    </>
  );
};

export default ChildrenList;
