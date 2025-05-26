import React from "react";
import { FaTimesCircle } from "react-icons/fa";
import * as Yup from "yup";
import { Form, Formik } from "formik";
import { useMutation, useQueryClient } from "@tanstack/react-query";

import {
  setError,
  setMessage,
  setSuccess,
} from "../../../../../store/StoreAction";
import { queryData } from "../../../helper/queryData";
import {
  InputSelect,
  InputText,
  InputTextArea,
} from "../../../custom-hooks/FormInputs";
import ModalWrapperSide from "../../../partials/modal/ModalWrapperSide";
import { StoreContext } from "../../../../../store/StoreContext";
import useQueryData from "../../../helper/useQueryData";

const ModalAddMainExperience = ({ itemEdit, setIsModal }) => {
  const { store, dispatch } = React.useContext(StoreContext);
  const [animate, setAnimate] = React.useState("translate-x-full");
  const queryClient = useQueryClient();

  const {
    isLoading,
    isFetching,
    error,
    data: category,
  } = useQueryData(
    `/rest/v1/controllers/developer/settings/experience/experience.php`,
    "get",
    "experience",
    {},
    null,
    true
  );

  const filterActiveCategory = category?.data.filter(
    (item) =>
      item.experience_is_active == 1 ||
      (itemEdit && itemEdit.mainexperience_id == item.experience_aid)
  );

  const mutation = useMutation({
    mutationFn: (values) =>
      queryData(
        itemEdit
          ? `/rest/v1/controllers/developer/experience/experience.php?mainexperienceid=${itemEdit.mainexperience_aid}`
          : `/rest/v1/controllers/developer/experience/experience.php`,
        itemEdit ? "PUT" : "POST",
        values
      ),
    onSuccess: (data) => {
      queryClient.invalidateQueries({ queryKey: ["mainexperience"] });

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
    mainexperience_title: itemEdit ? itemEdit.mainexperience_title : "",
    mainexperience_description: itemEdit
      ? itemEdit.mainexperience_description
      : "",
    mainexperience_category: itemEdit
      ? itemEdit.mainexperience_category || ""
      : "",
    mainexperience_title_old: itemEdit ? itemEdit.mainexperience_title : "",
  };

  const yupSchema = Yup.object({
    mainexperience_title: Yup.string().required("required"),
    mainexperience_description: Yup.string().required("required"),
    mainexperience_category: Yup.string().required("required"),
  });

  const handleClose = () => {
    setAnimate("translate-x-full");
    setTimeout(() => {
      setIsModal(false);
    }, 200);
  };

  React.useEffect(() => {
    setAnimate();
  }, []);

  return (
    <ModalWrapperSide handleClose={handleClose} className={`moodal ${animate}`}>
      <div className="modal__header">
        <h3>{itemEdit ? "Update" : "Add"} Experiences</h3>
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
          {(props) => (
            <Form>
              <div className="forms_wrapper">
                <div className="forms">
                  <div className="relative mt-3 mb-5">
                    <InputText
                      label="Title"
                      type="text"
                      name="mainexperience_title"
                      disabled={false}
                    />
                  </div>
                  <div className="relative mt-3 mb-5">
                    <InputSelect
                      label="Category"
                      type="text"
                      name="mainexperience_category"
                      onChange={(e) => e}
                      disabled={mutation.isPending}
                    >
                      <optgroup label="-- Select a category">
                        {isLoading || isFetching ? (
                          <option disabled value="">
                            Loading...
                          </option>
                        ) : error ? (
                          <option disabled value="">
                            Server Error
                          </option>
                        ) : filterActiveCategory?.length == 0 ? (
                          <option disabled value="">
                            No Data
                          </option>
                        ) : (
                          <>
                            <option value="" hidden></option>
                            {filterActiveCategory.map((item, index) => {
                              return (
                                <option key={index} value={item.experience_aid}>
                                  {item.experience_title}
                                </option>
                              );
                            })}
                          </>
                        )}
                      </optgroup>
                    </InputSelect>
                  </div>

                  <div className="relative mt-3 mb-5">
                    <InputTextArea
                      label="Description"
                      type="text"
                      name="mainexperience_description"
                      disabled={false}
                    />
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
          )}
        </Formik>
      </div>
    </ModalWrapperSide>
  );
};

export default ModalAddMainExperience;
