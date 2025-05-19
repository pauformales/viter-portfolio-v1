import React from "react";
import ModalWrapperSide from "../../../../partials/modal/ModalWrapperSide";
import { FaTimesCircle } from "react-icons/fa";
import * as Yup from "yup";
import { Form, Formik } from "formik";
import {
  InputSelect,
  InputText,
  InputTextArea,
} from "../../../../custom-hooks/FormInputs";
import { queryData } from "../../../../helper/queryData";
import { useMutation, useQueryClient } from "@tanstack/react-query";
import { StoreContext } from "../../../../../../store/StoreContext";
import {
  setError,
  setMessage,
  setSuccess,
} from "../../../../../../store/StoreAction";
import useQueryData from "../../../../helper/useQueryData";

const ModalAddSettingsNotification = ({ itemEdit, setIsModal }) => {
  const { store, dispatch } = React.useContext(StoreContext);
  const [animate, setAnimate] = React.useState("translate-x-full");

  const {
    isLoading,
    isFetching,
    error,
    data: category,
  } = useQueryData(
    `/rest/v1/controllers/developer/settings/category/category.php`,
    "get",
    "category",
    {},
    null,
    true
  );

  const filterActiveCategory = category?.data.filter(
    (item) =>
      item.category_is_active == 1 ||
      (itemEdit && itemEdit.notification_purpose == item.category_aid)
  );

  const queryClient = useQueryClient();
  const mutation = useMutation({
    mutationFn: (values) =>
      queryData(
        itemEdit
          ? `/rest/v1/controllers/developer/settings/notification/notification.php?notificationid=${itemEdit.notification_aid}`
          : `/rest/v1/controllers/developer/settings/notification/notification.php`,
        itemEdit ? "PUT" : "POST",
        values
      ),
    onSuccess: (data) => {
      queryClient.invalidateQueries({ queryKey: ["notification"] });

      if (!data.success) {
        dispatch(setMessage(data.error));
        dispatch(setError(true));
      } else {
        setIsModal(false);
        dispatch(setMessage(`Successfully ${itemEdit ? "updated" : "added"}.`));
        dispatch(setSuccess(true));
      }
    },
  });

  const initVal = {
    notification_name: itemEdit ? itemEdit.notification_name : "",
    notification_purpose: itemEdit ? itemEdit.notification_purpose : "",
    notification_email: itemEdit ? itemEdit.notification_email : "",
  };

  const yupSchema = Yup.object({
    notification_name: Yup.string().required("required"),
    notification_purpose: Yup.string().required("required"),
    notification_email: Yup.string()
      .email("Invalid email")
      .required("required"),
  });

  const handleClose = () => {
    setAnimate("translate-x-full");
    setTimeout(() => {
      setIsModal(false); // CLOSE MODAL
    }, 200);
  };

  React.useEffect(() => {
    setAnimate();
  }, []);

  return (
    <ModalWrapperSide handleClose={handleClose} className={`${animate}`}>
      <div className="modal__header">
        <h3>{itemEdit ? "Update" : "Add"} Notification</h3>
        <button
          type="button"
          className="absolute top-0 right-0"
          onClick={handleClose}
        >
          <FaTimesCircle className="text-lg" />
        </button>
      </div>

      <div className="modal__body">
        <Formik
          initialValues={initVal}
          validationSchema={yupSchema}
          onSubmit={(values) => {
            mutation.mutate(values);
          }}
        >
          {(props) => {
            return (
              <Form>
                <div className="forms_wrapper">
                  <div className="forms">
                    <div className="relative mt-3 mb-5">
                      <InputText
                        label="Name"
                        type="text"
                        name="notification_name"
                        disabled={mutation.isPending}
                      />
                    </div>

                    {/* Email Field */}
                    <div className="relative mt-3 mb-5">
                      <InputText
                        label="Email"
                        type="email"
                        name="notification_email"
                        disabled={mutation.isPending}
                      />
                    </div>

                    <div className="relative mt-3 mb-5">
                      <InputSelect
                        label="Purpose"
                        type="text"
                        name="notification_purpose"
                        onChange={(e) => e}
                        disabled={mutation.isPending}
                      >
                        <optgroup>
                          {isLoading || isFetching ? (
                            <option disabled value="">
                              Loading...
                            </option>
                          ) : error ? (
                            <option disabled value="">
                              Server Error
                            </option>
                          ) : (
                            <>
                              <option value="" selected>
                                --
                              </option>
                              <option value="New Donor">New Donor</option>
                              <option value="Donation Receipt">
                                Donation Receipt
                              </option>
                            </>
                          )}
                        </optgroup>
                      </InputSelect>
                    </div>
                  </div>

                  <div className="actions">
                    <button
                      type="submit"
                      className="btn-modal-submit"
                      disabled={!props.dirty}
                    >
                      {itemEdit ? "Save" : "Add"}
                    </button>
                    <button
                      type="reset"
                      className="btn-modal-cancel"
                      onClick={handleClose}
                    >
                      Cancel
                    </button>
                  </div>
                </div>
              </Form>
            );
          }}
        </Formik>
      </div>
    </ModalWrapperSide>
  );
};

export default ModalAddSettingsNotification;
