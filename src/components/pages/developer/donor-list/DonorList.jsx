import React from "react";
import Header from "../../../partials/Header";
import Navigation from "../Navigation";
import BreadCrumbs from "../../../partials/BreadCrumbs";
import { FaPlus } from "react-icons/fa6";
import Footer from "../../../partials/Footer";
import DonorListTable from "./DonorListTable";
import ModalAddSettingsDonor from "./ModalAddSettingsDonor";

const DonorList = () => {
  const [itemEdit, setItemEdit] = React.useState(null);
  const [isModalDonor, setIsModalDonor] = React.useState(false);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalDonor(true);
  };

  return (
    <>
      <Header />
      <Navigation menu="donor" />
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
          <h2 className="text-base">Donor</h2>
          <div className="pt-3">
            <DonorListTable
              setItemEdit={setItemEdit}
              setIsModal={setIsModalDonor}
            />
          </div>
        </div>

        {/* FOOTER */}
        <Footer />

        {isModalDonor && (
          <ModalAddSettingsDonor
            itemEdit={itemEdit}
            setIsModal={setIsModalDonor}
          />
        )}
      </div>
    </>
  );
};

export default DonorList;
