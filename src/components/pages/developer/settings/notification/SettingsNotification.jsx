import React from "react";
import Header from "../../../../partials/Header";
import Navigation from "../../Navigation";
import BreadCrumbs from "../../../../partials/BreadCrumbs";
import Footer from "../../../../partials/Footer";
import { FaPlus } from "react-icons/fa";
import SettingsNotificationList from "./SettingsNotificationList";
import ModalAddSettingsNotification from "./ModalAddSettingsNotification";

const SettingsNotification = () => {
  const [isModalNotification, setIsModalNotification] = React.useState(false);
  const [itemEdit, setItemEdit] = React.useState(null);

  const handleAdd = () => {
    setItemEdit(null);
    setIsModalNotification(true);
  };

  return (
    <>
      <Header />
      <Navigation menu="settings" subMenu="notification" />
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
          <h2>Notification</h2>
          <div className="pt-3">
            <SettingsNotificationList
              setItemEdit={setItemEdit}
              setIsModal={setIsModalNotification}
            />
          </div>
        </div>

        {/* FOOTER */}
        <Footer />
      </div>

      {isModalNotification && (
        <ModalAddSettingsNotification
          itemEdit={itemEdit}
          setIsModal={setIsModalNotification}
        />
      )}
    </>
  );
};

export default SettingsNotification;
